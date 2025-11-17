<?php

namespace App\Filament\Client\Resources\Students\Schemas;

use App\Enums\Student\AutonomyEnum;
use App\Enums\Student\LearningProfileEnum;
use App\Enums\Student\LiteracyStageEnum;
use App\Enums\Student\SocializationEnum;
use App\Enums\Student\StudentShiftEnum;
use App\Enums\Student\SupportLevelEnum;
use App\Enums\Student\VerbalCommunicationEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentForm
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
                    TextInput::make('full_name')
                        ->label('Nome Completo')
                        ->required(),
                    DatePicker::make('birth_date')
                        ->label('Data de Nascimento')
                        ->required(),
                    Select::make('school_id')
                        ->relationship('school', 'name')
                        ->label('Escola')
                        ->native(false)
                        ->preload()
                        ->searchable()
                        ->required(),
                    Select::make('grade_id')
                        ->relationship('grade', 'name')
                        ->label('Série')
                        ->required(),
                    Select::make('shift')
                        ->options(StudentShiftEnum::class)
                        ->label('Turno')
                        ->required(),
                    
                    Select::make('support_level')
                        ->options(SupportLevelEnum::class)
                        ->label('Nível de Suporte')
                        ->required(),
                    Select::make('literacy_stage')
                        ->options(LiteracyStageEnum::class)
                        ->label('Estágio de Alfabetização')
                        ->required(),
                    Select::make('socialization')
                        ->options(SocializationEnum::class)
                        ->label('Socialização')
                        ->required(),
                    Select::make('verbal_communication')
                        ->options(VerbalCommunicationEnum::class)
                        ->label('Comunicação Verbal')
                        ->required(),
                    Select::make('autonomy')
                        ->options(AutonomyEnum::class)
                        ->label('Autonomia')
                        ->required(),
                    TextInput::make('concentration_time')
                        ->label('Tempo de Concentração')
                        ->required()
                        ->numeric()
                        ->suffix('min')
                        ->minValue(0)
                        ->maxValue(120),
                    Select::make('learning_profile')
                        ->options(LearningProfileEnum::class)
                        ->label('Perfil de Aprendizagem')
                        ->required(),
                    Select::make('cids')
                        ->relationship('cids', 'name')
                        ->label('CIDs')
                        ->multiple()
                        ->native(false)
                        ->preload()
                        ->searchable()
                        ->columnSpanFull()
                        ->required(),
                    Textarea::make('other_relevant_info')
                        ->label('Outras Informações Relevantes')
                        ->columnSpanFull(),
                ])
            ]);
    }
}
