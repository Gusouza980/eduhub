<?php

namespace App\Filament\Client\Resources\Coordinators\Schemas;

use App\Enums\UserRolesEnum;
use App\Schemas\AddressSchema;
use App\Schemas\DocumentSchema;
use App\Schemas\PhoneSchema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class CoordinatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                        $data['role'] = UserRolesEnum::COORDINATOR->value;
                        return $data;
                    }),
                Select::make('school_id')
                    ->label('Escola')
                    ->relationship('school', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                ...AddressSchema::fields(),
                ...DocumentSchema::fields(),
                ...PhoneSchema::fields(),
                Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),
            ]);
    }
}
