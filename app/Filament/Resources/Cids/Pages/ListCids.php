<?php

namespace App\Filament\Resources\Cids\Pages;

use App\Filament\Resources\Cids\CidResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCids extends ListRecords
{
    protected static string $resource = CidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
