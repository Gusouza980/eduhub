<?php

namespace App\Filament\Resources\Cids;

use App\Filament\Resources\Cids\Pages\CreateCid;
use App\Filament\Resources\Cids\Pages\EditCid;
use App\Filament\Resources\Cids\Pages\ListCids;
use App\Filament\Resources\Cids\Schemas\CidForm;
use App\Filament\Resources\Cids\Tables\CidsTable;
use App\Models\Cid;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CidResource extends Resource
{
    protected static ?string $model = Cid::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CidForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CidsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCids::route('/'),
            'create' => CreateCid::route('/create'),
            'edit' => EditCid::route('/{record}/edit'),
        ];
    }
}
