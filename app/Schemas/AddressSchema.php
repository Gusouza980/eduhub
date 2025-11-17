<?php

namespace App\Schemas;

use App\Enums\StatesEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\TextEntry;

class AddressSchema
{
    public static function fields(): array
    {
        return [
            TextInput::make('street')
                ->label('Rua')
                ->maxLength(100)
                ->required(),
            TextInput::make('number')
                ->label('Número')
                ->maxLength(10)
                ->required(),
            TextInput::make('complement')
                ->label('Complemento')
                ->maxLength(40),
            TextInput::make('neighborhood')
                ->label('Bairro')
                ->maxLength(60)
                ->required(),
            TextInput::make('city')
                ->label('Cidade')
                ->maxLength(40)
                ->required(),
            Select::make('state')
                ->label('Estado')
                ->options(StatesEnum::class)
                ->required(),
            TextInput::make('zip_code')
                ->label('CEP')
                ->maxLength(9)
                ->mask('99999-999')
                ->required(),
        ];
    }

    public static function columns(): array
    {
        return [
            TextColumn::make('street')
                ->label('Rua')
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            TextColumn::make('number')
                ->label('Número')
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            TextColumn::make('complement')
                ->label('Complemento')
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            TextColumn::make('neighborhood')
                ->label('Bairro')
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            TextColumn::make('city')
                ->label('Cidade')
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            TextColumn::make('state')
                ->label('Estado')
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            TextColumn::make('zip_code')
                ->label('CEP')
                ->placeholder('-')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
        ];
    }

    public static function entries(): array
    {
        return [
            TextEntry::make('street')
                ->label('Rua')
                ->placeholder('-'),
            TextEntry::make('number')
                ->label('Número')
                ->placeholder('-'),
            TextEntry::make('complement')
                ->label('Complemento')
                ->placeholder('-'),
            TextEntry::make('neighborhood')
                ->label('Bairro')
                ->placeholder('-'),
            TextEntry::make('city')
                ->label('Cidade')
                ->placeholder('-'),
            TextEntry::make('state')
                ->label('Estado')
                ->placeholder('-'),
            TextEntry::make('zip_code')
                ->label('CEP')
                ->placeholder('-'),
        ];
    }
}