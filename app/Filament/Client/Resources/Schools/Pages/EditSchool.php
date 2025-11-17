<?php

namespace App\Filament\Client\Resources\Schools\Pages;

use App\Filament\Client\Resources\Schools\SchoolResource;
use App\Models\School;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditSchool extends EditRecord
{
    protected static string $resource = SchoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
            Action::make('grades')
                ->label('Séries')
                ->url(fn (School $record) => SchoolResource::getUrl('grades', ['record' => $record])),
            Action::make('subjects')
                ->label('Disciplinas')
                ->url(fn (School $record) => SchoolResource::getUrl('subjects', ['record' => $record])),
        ];
    }
}
