<?php

namespace App\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class DocumentSchema
{
    public static function fields(): array
    {
        return [
            TextInput::make('document')
                ->label('CPF/CNPJ')
                ->maxLength(18)
                ->mask(RawJs::make(<<<'JS'
                    $input.length <= 14 
                        ? '999.999.999-99' 
                        : '99.999.999/9999-99'
                JS))
                ->required(),
        ];
    }
}