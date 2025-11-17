<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRolesEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRolesEnum::class,
        ];
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function coordinator(): HasOne
    {
        return $this->hasOne(Coordinator::class);
    }

    public function professor(): HasOne
    {
        return $this->hasOne(Professor::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if($panel->getId() === 'admin') {
            return $this->role === UserRolesEnum::ADMIN;
        }
        
        if($panel->getId() === 'client') {
            return $this->role === UserRolesEnum::MANAGER || $this->role === UserRolesEnum::TEACHER || $this->role === UserRolesEnum::COORDINATOR;
        }

        return false;
    }
}
