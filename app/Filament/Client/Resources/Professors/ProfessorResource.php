<?php

namespace App\Filament\Client\Resources\Professors;

use App\Filament\Client\Resources\Professors\Pages\CreateProfessor;
use App\Filament\Client\Resources\Professors\Pages\EditProfessor;
use App\Filament\Client\Resources\Professors\Pages\ListProfessors;
use App\Filament\Client\Resources\Professors\Pages\ViewProfessor;
use App\Filament\Client\Resources\Professors\Schemas\ProfessorForm;
use App\Filament\Client\Resources\Professors\Schemas\ProfessorInfolist;
use App\Filament\Client\Resources\Professors\Tables\ProfessorsTable;
use App\Models\Professor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ProfessorResource extends Resource
{
    protected static ?string $model = Professor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected static ?string $navigationLabel = 'Professores';
    protected static ?string $pluralNavigationLabel = 'Professores';
    protected static string|UnitEnum|null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 1;
    protected static ?string $breadcrumb = 'Professores';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProfessorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProfessorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfessorsTable::configure($table);
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
            'index' => ListProfessors::route('/'),
            'create' => CreateProfessor::route('/create'),
            'view' => ViewProfessor::route('/{record}'),
            'edit' => EditProfessor::route('/{record}/edit'),
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
