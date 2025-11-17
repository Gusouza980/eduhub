<?php

namespace App\Filament\Client\Resources\Schools\Pages;

use App\Filament\Client\Resources\Schools\SchoolResource;
use App\Models\School;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewSchool extends ViewRecord
{
    protected static string $resource = SchoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('grades')
                ->label('Séries')
                ->url(fn (School $record) => SchoolResource::getUrl('grades', ['record' => $record])),
            Action::make('subjects')
                ->label('Disciplinas')
                ->url(fn (School $record) => SchoolResource::getUrl('subjects', ['record' => $record])),
        ];
    }
}
