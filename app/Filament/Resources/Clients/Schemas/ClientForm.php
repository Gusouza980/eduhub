<?php

namespace App\Filament\Resources\Clients\Schemas;

use App\Enums\UserRolesEnum;
use App\Schemas\AddressSchema;
use App\Schemas\DocumentSchema;
use App\Schemas\PhoneSchema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class ClientForm
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
                        $data['role'] = UserRolesEnum::MANAGER->value;
                        return $data;
                    }),
                Group::make()
                    ->columnSpanFull()
                    ->columns([
                        'xs' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 4,
                    ])
                    ->schema([
                        ...AddressSchema::fields(),
                        ...DocumentSchema::fields(),
                        ...PhoneSchema::fields(),
                    ]),
            ]);
    }
}
