<?php

namespace App\Filament\Client\Resources\Schools\Actions;

use App\Filament\Client\Resources\Schools\SchoolResource;
use App\Models\School;
use App\Services\SchoolService;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Closure;

class CopyStructureAction
{
    public static function configure(School $school, ?Closure $callback = null): Action
    {
        return Action::make('copy-structure')
            ->label('Copiar Estrutura')
            ->modalDescription('Copiar a estrutura de séries e disciplinas de outra escola')
            ->modalSubmitActionLabel('Copiar')
            ->modalCancelActionLabel('Cancelar')
            ->schema([
                Select::make('school_id')
                    ->label('Escola')
                    ->preload()
                    ->searchable()
                    ->options(School::fromClient()->whereNot('id', $school->id)->get()->pluck('name', 'id'))
                    ->required(),
            ])
            ->action(function (array $data) use ($school, $callback) {
                try{
                    $schoolService = new SchoolService();
                    $schoolService->copyStructure($school, School::find($data['school_id']));    
                    Notification::make()
                        ->title('Estrutura copiada com sucesso')
                        ->body('A estrutura de séries e disciplinas foi copiada com sucesso para a escola ' . School::find($data['school_id'])->name)
                        ->success()
                        ->send();
                    $callback();
                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Erro ao copiar estrutura')
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                    throw new Halt($e->getMessage());
                }
            });
    }
}