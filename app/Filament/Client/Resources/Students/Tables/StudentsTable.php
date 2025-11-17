<?php

namespace App\Filament\Client\Resources\Students\Tables;

use App\Enums\Student\AutonomyEnum;
use App\Enums\Student\LearningProfileEnum;
use App\Enums\Student\LiteracyStageEnum;
use App\Enums\Student\SocializationEnum;
use App\Enums\Student\StudentShiftEnum;
use App\Enums\Student\SupportLevelEnum;
use App\Enums\Student\VerbalCommunicationEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Nome Completo')
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->label('Data de Nascimento')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('school.name')
                    ->label('Escola'),
                TextColumn::make('grade.name')
                    ->label('Série'),
                TextColumn::make('shift')
                    ->badge()
                    ->label('Turno'),
                TextColumn::make('support_level')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('literacy_stage')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('socialization')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('verbal_communication')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('autonomy')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('concentration_time')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('learning_profile')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Excluído em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('school_id')
                    ->label('Escola')
                    ->relationship('school', 'name')
                    ->preload()
                    ->native(false)
                    ->searchable(),
                SelectFilter::make('grade_id')
                    ->label('Série')
                    ->relationship('grade', 'name'),
                SelectFilter::make('shift')
                    ->label('Turno')
                    ->options(StudentShiftEnum::class),
                SelectFilter::make('support_level')
                    ->label('Nível de Suporte')
                    ->options(SupportLevelEnum::class),
                SelectFilter::make('literacy_stage')
                    ->label('Estágio de Alfabetização')
                    ->options(LiteracyStageEnum::class),
                SelectFilter::make('socialization')
                    ->label('Socialização')
                    ->options(SocializationEnum::class),
                SelectFilter::make('verbal_communication')
                    ->label('Comunicação Verbal')
                    ->options(VerbalCommunicationEnum::class),
                SelectFilter::make('autonomy')
                    ->label('Autonomia')
                    ->options(AutonomyEnum::class),
                SelectFilter::make('learning_profile')
                    ->label('Perfil de Aprendizagem')
                    ->options(LearningProfileEnum::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
