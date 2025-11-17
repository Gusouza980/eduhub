<x-filament-panels::page>
    <livewire:client.school.list-school-classes :key="$this->record->id . '_' . $this->randomKey" :schoolId="$this->record->id" />
</x-filament-panels::page>
