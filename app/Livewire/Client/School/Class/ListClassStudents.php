<?php

namespace App\Livewire\Client\School\Class;

use App\Models\GradeClassStudent;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListClassStudents extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public $gradeClassId;
    public $schoolId;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => GradeClassStudent::query()->with('student')->where('grade_class_id', $this->gradeClassId))
            ->columns([
                TextColumn::make('student.full_name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add-student')
                    ->label('Adicionar Estudante')
                    ->schema([
                        Select::make('student_id')
                            ->label('Estudante')
                            ->options(Student::where('school_id', $this->schoolId)->pluck('full_name', 'id'))
                            ->required(),
                    ])
                    ->modalHeading('Adicionar Estudante')
                    ->modalDescription('Adicione um novo estudante à turma')
                    ->modalSubmitActionLabel('Adicionar')
                    ->modalCancelActionLabel('Cancelar')
                    ->action(function (array $data): void {
                        GradeClassStudent::create([
                            'grade_class_id' => $this->gradeClassId,
                            'student_id' => $data['student_id'],
                            'is_active' => true,
                        ]);
                        Notification::make()
                            ->title('Estudante adicionado à turma com sucesso')
                            ->success()
                            ->send();
                    })
                    ->icon(Heroicon::OutlinedPlus),
            ])
            ->recordActions([
                DeleteAction::make()
                    ->label('Remover Estudante')
                    ->icon(Heroicon::OutlinedTrash)
                    ->modalHeading('Remover Estudante')
                    ->modalDescription('Tem certeza que deseja remover o estudante da turma?')
                    ->modalSubmitActionLabel('Remover')
                    ->modalCancelActionLabel('Cancelar')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.client.school.class.list-class-students');
    }
}
