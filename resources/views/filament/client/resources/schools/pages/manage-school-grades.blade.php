<x-filament-panels::page>
    @foreach ($this->grades as $grade)
        <x-filament::section>
            <x-slot name="heading">
                <h2 class="font-bold">{{ $grade->name }}</h2>
            </x-slot>
            <livewire:list-grade-subjects :key="$grade->id . '_' . $this->school->id . '_' . $this->randomKey" :gradeId="$grade->id" :schoolId="$this->school->id" />
        </x-filament::section>
    @endforeach
</x-filament-panels::page>
