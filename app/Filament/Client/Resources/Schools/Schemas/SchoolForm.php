<?php

namespace App\Filament\Client\Resources\Schools\Schemas;

use App\Schemas\AddressSchema;
use App\Schemas\PhoneSchema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->columnSpanFull()
                    ->columns([
                        'xs' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 4,
                    ])
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->required()
                            ->label('Nome'),
                        TextInput::make('alias')
                            ->label('Sigla'),
                        TextInput::make('email')
                                
                            ->label('Email')
                            ->email(),
                        ...AddressSchema::fields(),
                        TextInput::make('cnpj')
                            ->label('CNPJ')
                            ->required()
                            ->mask('99.999.999/9999-99'),
                        ...PhoneSchema::fields(),
                        
                        TextInput::make('site')
                            ->label('Site')
                            ->url()
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),
                    ]),
            ]);
    }
}
