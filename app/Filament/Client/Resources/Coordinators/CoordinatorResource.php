<?php

namespace App\Filament\Client\Resources\Coordinators;

use App\Filament\Client\Resources\Coordinators\Pages\CreateCoordinator;
use App\Filament\Client\Resources\Coordinators\Pages\EditCoordinator;
use App\Filament\Client\Resources\Coordinators\Pages\ListCoordinators;
use App\Filament\Client\Resources\Coordinators\Pages\ViewCoordinator;
use App\Filament\Client\Resources\Coordinators\Schemas\CoordinatorForm;
use App\Filament\Client\Resources\Coordinators\Schemas\CoordinatorInfolist;
use App\Filament\Client\Resources\Coordinators\Tables\CoordinatorsTable;
use App\Models\Coordinator;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class CoordinatorResource extends Resource
{
    protected static ?string $model = Coordinator::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'user.name';
    protected static ?string $navigationLabel = 'Coordenadores';
    protected static ?string $pluralNavigationLabel = 'Coordenadores';
    protected static string|UnitEnum|null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CoordinatorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CoordinatorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoordinatorsTable::configure($table);
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
            'index' => ListCoordinators::route('/'),
            'create' => CreateCoordinator::route('/create'),
            'view' => ViewCoordinator::route('/{record}'),
            'edit' => EditCoordinator::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
