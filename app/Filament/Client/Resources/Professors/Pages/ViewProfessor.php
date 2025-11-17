<?php

namespace App\Filament\Client\Resources\Professors\Pages;

use App\Filament\Client\Resources\Professors\ProfessorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProfessor extends ViewRecord
{
    protected static string $resource = ProfessorResource::class;
    protected static ?string $title = 'Visualizar Professor';
    
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
