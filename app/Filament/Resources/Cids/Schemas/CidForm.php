<?php

namespace App\Filament\Resources\Cids\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CidForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
