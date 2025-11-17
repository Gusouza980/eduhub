<?php

namespace App\Filament\Client\Resources\Schools\Actions;

use App\Models\Grade;
use App\Models\GradeSubject;
use App\Models\School;
use App\Models\Subject;
use App\Services\SchoolService;
use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Icons\Heroicon;

class AddSubjectToGradeAction
{
    public static function configure(int $gradeId, int $schoolId, ?Closure $callback = null): Action
    {
        $gradeSubjects = GradeSubject::where('grade_id', $gradeId)->where('school_id', $schoolId)->get();
        $subjects = $gradeSubjects->pluck('subject_id')->toArray();

        return Action::make('add-subject')
                    ->label('Adicionar Disciplina')
                    ->icon(Heroicon::OutlinedPlus)
                    ->modalHeading('Adicionar Disciplina')
                    ->modalDescription('Adicionar uma nova disciplina à série')
                    ->modalSubmitActionLabel('Adicionar')
                    ->modalCancelActionLabel('Cancelar')
                    ->schema([
                        Select::make('subject_id')
                            ->label('Disciplina')
                            ->preload()
                            ->searchable()
                            ->options(
                                Subject::fromClient()->whereNotIn('id', $subjects)->get()->pluck('name', 'id')
                            )
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),
                    ])
                    ->action(function (array $data) use ($gradeId, $schoolId, $callback) {
                        try{
                            $grade = Grade::find($gradeId);
                            $subject = Subject::find($data['subject_id']);
                            $schoolService = new SchoolService();
                            $schoolService->addSubjectToGrade($schoolId, $gradeId, $data['subject_id'], $data['is_active']);
                            ($callback) ? $callback() : null;
                            Notification::make()
                                ->title('Disciplina adicionada à série com sucesso')
                                ->body('A disciplina ' . $subject->name . ' foi adicionada à série ' . $grade->name . ' com sucesso')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Erro ao adicionar disciplina à série')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                            throw new Halt($e->getMessage());
                        }
                    });
    }
}   