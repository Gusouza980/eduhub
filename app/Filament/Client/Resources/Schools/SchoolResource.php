<?php

namespace App\Filament\Client\Resources\Schools;

use App\Filament\Client\Resources\Schools\Pages\ClassDetails;
use App\Filament\Client\Resources\Schools\Pages\CreateSchool;
use App\Filament\Client\Resources\Schools\Pages\EditSchool;
use App\Filament\Client\Resources\Schools\Pages\ListSchools;
use App\Filament\Client\Resources\Schools\Pages\ManageSchoolClasses;
use App\Filament\Client\Resources\Schools\Pages\ManageSchoolGrades;
use App\Filament\Client\Resources\Schools\Pages\ManageSchoolSubjects;
use App\Filament\Client\Resources\Schools\Pages\ViewSchool;
use App\Filament\Client\Resources\Schools\RelationManagers\GradesRelationManager;
use App\Filament\Client\Resources\Schools\RelationManagers\SubjectsRelationManager;
use App\Filament\Client\Resources\Schools\Resources\Grades\GradeResource;
use App\Filament\Client\Resources\Schools\Schemas\SchoolForm;
use App\Filament\Client\Resources\Schools\Schemas\SchoolInfolist;
use App\Filament\Client\Resources\Schools\Tables\SchoolsTable;
use App\Models\School;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Escolas';
    protected static ?string $pluralNavigationLabel = 'Escolas';
    protected static string|UnitEnum|null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 1;
    protected static ?string $breadcrumb = 'Escolas';

    public static function form(Schema $schema): Schema
    {
        return SchoolForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchoolInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchools::route('/'),
            'create' => CreateSchool::route('/create'),
            'view' => ViewSchool::route('/{record}'),
            'edit' => EditSchool::route('/{record}/edit'),
            'grades' => ManageSchoolGrades::route('/{record}/grades'),
            'classes' => ManageSchoolClasses::route('/{record}/classes'),
            'classes.details' => ClassDetails::route('/{record}/classes/{gradeClassId}'),
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
