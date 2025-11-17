<?php

namespace App\Filament\Client\Resources\Schools\Pages;

use App\Filament\Client\Resources\Schools\SchoolResource;
use App\Models\GradeClass;
use App\Models\GradeSubject;
use App\Models\GradeSubjectPlan;
use Filament\Actions\Action;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Filament\Actions\Concerns\InteractsWithActions;

class ClassDetails extends Page implements HasActions
{
    use InteractsWithRecord;

    protected static string $resource = SchoolResource::class;

    protected static ?string $breadcrumb = 'Detalhes da Turma';

    protected static ?string $title = 'Detalhes da Turma';

    protected string $view = 'filament.client.resources.schools.pages.class-details';

    public $gradeClassId;

    #[Url('tab')]
    public $activeTab = 'estudantes';

    #[Computed()]
    public function getGradeClass(): GradeClass
    {
        return GradeClass::find($this->gradeClassId);
    }

    #[Computed()]
    public function getClassSubjects(): Collection
    {
        return GradeSubject::with('subject')
            ->where('grade_id', $this->getGradeClass->grade_id)
            ->where('school_id', $this->getGradeClass->school_id)
            ->get();
    }

    /**
     * Retorna os planos de aula organizados por matéria e bimestre
     */
    public function getPlansGroupedBySubjectAndBimester(): array
    {
        $grouped = [];

        // Para cada matéria da turma, buscar seus planos
        foreach ($this->getClassSubjects as $classSubject) {
            $plans = GradeSubjectPlan::where('grade_subject_id', $classSubject->id)
                ->get()
                ->keyBy('bimester');

            $grouped[$classSubject->id] = $plans->toArray();
        }

        return $grouped;
    }

    public function getTabs(): array
    {
        return [
            'estudantes' => 'Estudantes',
            'planos-de-aula' => 'Planos de Aula',
        ];
    }

    public function mount(int|string $record, int|string $gradeClassId): void
    {
        $this->record = $this->resolveRecord($record);
        $this->gradeClassId = $gradeClassId;
    }

    public function uploadPlanAction(): Action
    {
        return Action::make('upload-plan')
            ->label('Enviar Plano')
            ->icon(Heroicon::ArrowUpTray)
            ->modal(true)
            ->modalHeading('Upload de Plano de Aula')
            ->modalDescription('Upload de um plano de aula para a matéria')
            ->modalSubmitActionLabel('Upload')
            ->modalCancelActionLabel('Cancelar')
            ->schema([
                FileUpload::make('plan')
                    ->label('Plano de Aula')
                    ->disk('public')
                    ->required()
                    ->maxSize(1024)
                    ->maxFiles(1)
                    // ->acceptedMimeTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])
                    ->columnSpanFull(),
                TextInput::make('observations')
                    ->label('Observações')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->modalWidth('lg')
            ->action(function (array $data, array $arguments) {
                $gradeSubjectId = $arguments['gradeSubjectId'];
                $bimester = $arguments['bimester'];

                $plan = GradeSubjectPlan::updateOrCreate([
                    'grade_subject_id' => $gradeSubjectId,
                    'bimester' => $bimester,
                ], [
                    'file_path' => $data['plan'],
                    'observations' => $data['observations'],
                ]);

                $this->dispatch('$refresh');
            });
    }
}
