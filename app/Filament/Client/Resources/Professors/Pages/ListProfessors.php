<?php

namespace App\Filament\Client\Resources\Professors\Pages;

use App\Filament\Client\Resources\Professors\ProfessorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfessors extends ListRecords
{
    protected static string $resource = ProfessorResource::class;
    protected static ?string $title = 'Professores';
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
