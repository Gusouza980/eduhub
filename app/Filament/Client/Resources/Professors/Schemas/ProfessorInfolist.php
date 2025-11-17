<?php

namespace App\Filament\Client\Resources\Professors\Schemas;

use App\Models\Professor;
use App\Schemas\AddressSchema;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProfessorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Nome')
                    ->placeholder('-'),
                TextEntry::make('school.name')
                    ->label('Escola')
                    ->placeholder('-'),
                ...AddressSchema::entries(),
                TextEntry::make('document')
                    ->label('Documento')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->label('Telefone')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
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
                    ->visible(fn (Professor $record): bool => $record->trashed()),
            ]);
    }
}
