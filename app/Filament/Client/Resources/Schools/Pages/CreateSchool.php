<?php

namespace App\Filament\Client\Resources\Schools\Pages;

use App\Enums\UserRolesEnum;
use App\Filament\Client\Resources\Schools\SchoolResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSchool extends CreateRecord
{
    protected static string $resource = SchoolResource::class;
    protected static ?string $title = 'Nova Escola';

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        switch($user->role) {
            case UserRolesEnum::MANAGER:
                $data['client_id'] = $user->client->id;
                break;
            case UserRolesEnum::COORDINATOR:
                $data['client_id'] = $user->coordinator->client_id;
                break;
            case UserRolesEnum::TEACHER:
                $data['client_id'] = $user->professor->client_id;
                break;
        }

        return $data;
    }
}
