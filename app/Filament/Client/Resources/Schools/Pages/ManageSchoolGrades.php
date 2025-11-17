<?php

namespace App\Filament\Client\Resources\Schools\Pages;

use App\Filament\Client\Resources\Schools\Actions\CopyStructureAction;
use App\Filament\Client\Resources\Schools\SchoolResource;
use App\Models\Grade;
use App\Models\School;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use App\Traits\HasRandomKey;

class ManageSchoolGrades extends Page
{
    use HasRandomKey;

    protected static string $resource = SchoolResource::class;

    protected static ?string $breadcrumb = 'Gerenciar Séries';
    protected static ?string $title = 'Gerenciar Séries';

    protected string $view = 'filament.client.resources.schools.pages.manage-school-grades';

    public $record;

    #[Computed()]
    public function school(): School
    {
        return School::find($this->record);
    }

    #[Computed()]
    public function grades(): Collection
    {
        return Grade::whereIn('name', $this->school->grade_flow)->active()->get();
    }

    public function getBreadcrumbs(): array
    {
        return [
            ...$this->getResourceBreadcrumbs(),
            $this->school->name,
            $this->getBreadcrumb(),
        ];
    }

    public function getHeaderActions(): array
    {
        return [
            CopyStructureAction::configure($this->school, fn () => $this->refreshData()),
        ];
    }

    private function refreshData(): void
    {
        unset($this->school);
        unset($this->grades);
        $this->regenerateKey();
    }
}
