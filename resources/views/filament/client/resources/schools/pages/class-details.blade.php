<x-filament-panels::page>
    <x-filament::tabs>
        @foreach ($this->getTabs() as $tab => $label)
            <x-filament::tabs.item
                :active="$activeTab === $tab"
                wire:click="$set('activeTab', '{{$tab}}')"
            >
                {{ $label }}
            </x-filament::tabs.item>
        @endforeach
    </x-filament::tabs>

    @if ($activeTab === 'estudantes')
        <x-filament::section>
            <x-slot name="heading">
                <h2 class="font-bold">Estudantes</h2>
            </x-slot>
            <livewire:client.school.class.list-class-students :gradeClassId="$gradeClassId" :schoolId="$record->id" />
        </x-filament::section>
    @endif

    @if ($activeTab === 'planos-de-aula')
        @php
            $plansGrouped = $this->getPlansGroupedBySubjectAndBimester();
        @endphp

        <div class="space-y-6">
            @forelse ($this->getClassSubjects as $classSubject)
                <x-filament::section>
                    <x-slot name="heading">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary-500/10">
                                <x-filament::icon
                                    icon="heroicon-o-book-open"
                                    class="h-5 w-5 text-primary-600 dark:text-primary-400"
                                />
                            </div>
                            <div>
                                <h3 class="text-base font-semibold leading-6">
                                    {{ $classSubject->subject->name }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Planos de aula por bimestre
                                </p>
                            </div>
                        </div>
                    </x-slot>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @for($bimester = 1; $bimester <= 4; $bimester++)
                            @php
                                $plan = $plansGrouped[$classSubject->id][$bimester] ?? null;
                                $hasPlan = !is_null($plan);
                            @endphp

                            <div class="relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                                {{-- Header do Card --}}
                                <div class="border-b border-gray-200 bg-gradient-to-r from-primary-50 to-primary-100/50 p-4 dark:border-gray-700 dark:from-primary-900/20 dark:to-primary-800/20">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-500/20">
                                                <span class="text-sm font-bold text-primary-700 dark:text-primary-300">
                                                    {{ $bimester }}º
                                                </span>
                                            </div>
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                Bimestre {{ $bimester }}
                                            </h4>
                                        </div>

                                        {{-- Status Badge --}}
                                        @if($hasPlan)
                                            <x-filament::badge color="success" size="sm">
                                                <div class="flex items-center gap-1">
                                                    <x-filament::icon
                                                        icon="heroicon-m-check-circle"
                                                        class="h-3 w-3"
                                                    />
                                                    Enviado
                                                </div>
                                            </x-filament::badge>
                                        @else
                                            <x-filament::badge color="gray" size="sm">
                                                Pendente
                                            </x-filament::badge>
                                        @endif
                                    </div>
                                </div>

                                {{-- Conteúdo do Card --}}
                                <div class="p-4">
                                    @if($hasPlan)
                                        {{-- Plano Existente --}}
                                        <div class="space-y-3">
                                            <div class="flex items-start gap-2">
                                                <x-filament::icon
                                                    icon="heroicon-m-document-text"
                                                    class="mt-0.5 h-4 w-4 text-gray-400"
                                                />
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                                        Arquivo
                                                    </p>
                                                    <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ basename($plan['file_path']) }}
                                                    </p>
                                                </div>
                                            </div>

                                            @if($plan['observations'])
                                                <div class="flex items-start gap-2">
                                                    <x-filament::icon
                                                        icon="heroicon-m-chat-bubble-left-right"
                                                        class="mt-0.5 h-4 w-4 text-gray-400"
                                                    />
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                                            Observações
                                                        </p>
                                                        <p class="line-clamp-2 text-sm text-gray-600 dark:text-gray-300">
                                                            {{ $plan['observations'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="flex items-center gap-2 pt-2">
                                                {{-- ESPAÇO PARA ACTION DE VISUALIZAR --}}
                                                <x-filament::button
                                                    tag="a"
                                                    color="gray"
                                                    size="xs"
                                                    outlined
                                                    icon="heroicon-m-eye"
                                                    class="flex-1"
                                                    href="{{ Storage::url($plan['file_path']) }}"
                                                    target="_blank"
                                                >
                                                    Visualizar
                                                </x-filament::button>

                                                {{-- ESPAÇO PARA ACTION DE EDITAR/SUBSTITUIR --}}
                                                <x-filament::button
                                                    color="primary"
                                                    size="xs"
                                                    outlined
                                                    icon="heroicon-m-arrow-up-tray"
                                                    class="flex-1"
                                                    wire:click="mountAction('uploadPlan', { gradeSubjectId: {{ $classSubject->id }}, bimester: {{ $bimester }}})"
                                                >
                                                    Substituir
                                                </x-filament::button>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Sem Plano --}}
                                        <div class="flex flex-col items-center justify-center py-6 text-center">
                                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                                                <x-filament::icon
                                                    icon="heroicon-o-document-plus"
                                                    class="h-6 w-6 text-gray-400"
                                                />
                                            </div>
                                            <p class="mb-3 text-xs text-gray-500 dark:text-gray-400">
                                                Nenhum plano cadastrado
                                            </p>

                                            {{-- ESPAÇO PARA ACTION DE UPLOAD --}}
                                            <x-filament::button
                                                color="primary"
                                                size="sm"
                                                icon="heroicon-m-arrow-up-tray"
                                                wire:click="mountAction('uploadPlan', { gradeSubjectId: {{ $classSubject->id }}, bimester: {{ $bimester }}})"
                                            >
                                                Enviar Plano
                                            </x-filament::button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endfor
                    </div>
                </x-filament::section>
            @empty
                <x-filament::section>
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                            <x-filament::icon
                                icon="heroicon-o-book-open"
                                class="h-8 w-8 text-gray-400"
                            />
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                            Nenhuma matéria cadastrada
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Esta turma ainda não possui matérias vinculadas.
                        </p>
                    </div>
                </x-filament::section>
            @endforelse
        </div>
    @endif
    <x-filament-actions::modals />
</x-filament-panels::page>
