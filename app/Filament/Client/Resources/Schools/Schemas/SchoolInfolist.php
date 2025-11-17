<?php

namespace App\Filament\Client\Resources\Schools\Schemas;

use App\Models\School;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SchoolInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns([
                        'xs' => 1,
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 4,
                        'xl' => 5,
                        '2xl' => 6,
                    ])
                    ->schema([
                        ImageEntry::make('logo')
                            ->label('Logo')
                            ->columnSpanFull()
                            ->placeholder('-'),
                        TextEntry::make('name')
                            ->label('Nome')
                            ->placeholder('-'),
                        TextEntry::make('alias')
                            ->label('Sigla')
                            ->placeholder('-'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->placeholder('-'),
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
                        TextEntry::make('cnpj')
                            ->label('CNPJ')
                            ->placeholder('-'),
                        TextEntry::make('phone')
                            ->label('Telefone')
                            ->placeholder('-'),
                        
                        TextEntry::make('site')
                            ->label('Site')
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
                            ->visible(fn (School $record): bool => $record->trashed()),
                    ])
            ]);
    }
}
