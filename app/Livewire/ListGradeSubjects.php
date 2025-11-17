<?php

namespace App\Livewire;

use App\Filament\Client\Resources\Schools\Actions\AddSubjectToGradeAction;
use App\Models\GradeSubject;
use App\Services\SchoolService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListGradeSubjects extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public $gradeId;
    public $schoolId;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => GradeSubject::query()->with('subject')->where('grade_id', $this->gradeId)->where('school_id', $this->schoolId))
            ->columns([
                TextColumn::make('subject.name')
                    ->label('Disciplina')
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Ativo'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->headerActions([
                AddSubjectToGradeAction::configure($this->gradeId, $this->schoolId),
            ])
            ->recordActions([
                DeleteAction::make()
                    ->label('Excluir')
                    ->modalHeading('Remover Disciplina')
                    ->modalDescription('Tem certeza que deseja remover a disciplina da série?')
                    ->modalSubmitActionLabel('Excluir')
                    ->modalCancelActionLabel('Cancelar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.list-grade-subjects');
    }
}
