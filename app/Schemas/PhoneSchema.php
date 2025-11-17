<?php

namespace App\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class PhoneSchema
{
    public static function fields(): array
    {
        return [
            TextInput::make('phone')
                ->label('Telefone')
                ->maxLength(15)
                ->mask(RawJs::make(<<<'JS'
                    $input.length > 11 
                        ? '(99) 99999-9999' 
                        : '(99) 9999-9999'
                JS))
                ->required(),
        ];
    }
}