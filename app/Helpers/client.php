<?php

use App\Enums\UserRolesEnum;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

if(!function_exists('getClientId')) {
    function getClientId(): int|null
    {
        $user = Auth::user();
        
        if(!$user) {
            return null;
        }

        switch($user->role) {
            case UserRolesEnum::MANAGER:
                return $user->client->id;
                break;
            case UserRolesEnum::COORDINATOR:
                return $user->coordinator->client_id;
                break;
            case UserRolesEnum::TEACHER:
                return $user->professor->client_id;
                break;
            default:
                return null;
        }
    }
}