<?php

namespace App\Filament\Resources\Cids\Pages;

use App\Filament\Resources\Cids\CidResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCid extends EditRecord
{
    protected static string $resource = CidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
