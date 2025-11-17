<?php

namespace App\Filament\Client\Resources\Professors\Schemas;

use App\Enums\UserRolesEnum;
use App\Schemas\AddressSchema;
use App\Schemas\DocumentSchema;
use App\Schemas\PhoneSchema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;


class ProfessorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns([
                        'xs' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 4,
                        '2xl' => 5,
                    ])
                    ->schema([
                        Group::make()
                            ->relationship('user')
                            ->columnSpanFull()
                            ->columns([
                                'xs' => 1,
                                'md' => 2
                            ])
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nome')
                                    ->maxLength(100)
                                    ->required(),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(100)
                                    ->required(),
                            ])
                            ->mutateRelationshipDataBeforeCreateUsing(function($data, $get) {
                                $fields = $get('./');
                                $data['password'] = clearString($fields['document']);
                                $data['role'] = UserRolesEnum::TEACHER->value;
                                return $data;
                            }),
                        Select::make('schools')
                            ->label('Escolas')
                            ->columnSpanFull()
                            ->relationship('schools', 'name')
                            ->native(false)
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->required(),
                        ...AddressSchema::fields(),
                        ...DocumentSchema::fields(),
                        ...PhoneSchema::fields(),
                        Select::make('is_active')
                            ->label('Ativo')
                            ->options([
                                true => 'Ativo',
                                false => 'Inativo',
                            ])
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }
}
