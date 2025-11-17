<?php

namespace App\Filament\Client\Resources\Schools\Pages;

use App\Filament\Client\Resources\Schools\SchoolResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use App\Traits\HasRandomKey;

class ManageSchoolClasses extends Page
{
    use InteractsWithRecord;
    use HasRandomKey;

    protected static string $resource = SchoolResource::class;
    protected static ?string $breadcrumb = 'Gerenciar Turmas';
    protected static ?string $title = 'Gerenciar Turmas';

    protected string $view = 'filament.client.resources.schools.pages.manage-school-classes';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
