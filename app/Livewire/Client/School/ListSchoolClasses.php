<?php

namespace App\Livewire\Client\School;

use App\Filament\Client\Resources\Schools\SchoolResource;
use App\Models\Grade;
use App\Models\GradeClass;
use App\Models\School;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListSchoolClasses extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public $schoolId;

    #[Computed()]
    public function getSchoolGrades(): Collection
    {
        $school = School::find($this->schoolId);
        return Grade::whereIn('name', $school->grade_flow)->active()->get();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => GradeClass::query()->with('grade')->where('school_id', $this->schoolId))
            ->columns([
                TextColumn::make('full_name')
                    ->label('Turma')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('grade.name')
                    ->label('Série')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('grade_id')
                    ->label('Série')
                    ->options(Grade::active()->pluck('name', 'id'))
                    ->preload()
                    ->searchable(),
                SelectFilter::make('year')
                    ->label('Ano')
                    ->options(fn (Builder $query) => GradeClass::query()->where('school_id', $this->schoolId)->pluck('year', 'year'))
                    ->preload()
                    ->searchable(),
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('details')
                        ->label('Detalhes')
                        ->url(fn (GradeClass $record) => SchoolResource::getUrl('classes.details', ['record' => $this->schoolId, 'gradeClassId' => $record->id]))
                        ->icon(Heroicon::OutlinedEye),
                    EditAction::make()
                    ->label('Editar')
                    ->icon(Heroicon::OutlinedPencil)
                    ->color('warning')
                    ->modalHeading('Editar Turma')
                    ->schema([
                        Select::make('grade_id')
                            ->label('Série')
                            ->options(Grade::whereNotIn('id', $this->getSchoolGrades()->pluck('id')->toArray())->pluck('name', 'id'))
                            ->required(),
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        TextInput::make('year')
                            ->label('Ano')
                            ->numeric()
                            ->step(1)
                            ->required(),
                        Select::make('is_active')
                            ->label('Ativo')
                            ->options([
                                true => 'Sim',
                                false => 'Não',
                            ])
                            ->required(),
                    ]),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.client.school.list-school-classes');
    }
}
