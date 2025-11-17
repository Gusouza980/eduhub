<?php

namespace App\Filament\Client\Resources\Students\Schemas;

use App\Models\Cid;
use App\Models\Student;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns([
                        'xs' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 4,
                    ])
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('full_name')
                            ->label('Nome Completo'),
                        TextEntry::make('birth_date')
                            ->label('Data de Nascimento')
                            ->date(),
                        TextEntry::make('school.name')
                            ->label('Escola'),
                        TextEntry::make('grade.name')
                            ->label('Série'),
                        TextEntry::make('shift')
                            ->label('Turno'),
                        
                        TextEntry::make('support_level')
                            ->label('Nível de Suporte'),
                        TextEntry::make('literacy_stage')
                            ->label('Estágio de Alfabetização'),
                        TextEntry::make('socialization')
                            ->label('Socialização'),
                        TextEntry::make('verbal_communication')
                            ->label('Comunicação Verbal'),
                        TextEntry::make('autonomy')
                            ->label('Autonomia'),
                        TextEntry::make('concentration_time')
                            ->label('Tempo de Concentração (minutos)')
                            ->numeric()
                            ->formatStateUsing(fn (int $state): string => $state . ' minutos'),
                        TextEntry::make('learning_profile')
                            ->label('Perfil de Aprendizagem'),
                        TextEntry::make('cids')
                            ->label('CIDs')
                            ->columnSpanFull()
                            ->formatStateUsing(function (Student $record): string {
                                return $record->cids->pluck('name')->implode(', ');
                            }),
                        TextEntry::make('other_relevant_info')
                            ->label('Outras Informações Relevantes')
                            ->placeholder('Sem informações')
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Atualizado em')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->label('Excluído em')
                            ->dateTime()
                            ->visible(fn (Student $record): bool => $record->trashed()),
                    ])
            ]);
    }
}
