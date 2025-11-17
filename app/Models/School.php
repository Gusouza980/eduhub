<?php

namespace App\Models;

use App\Traits\HasCnpj;
use App\Traits\HasPhone;
use App\Traits\HasZipCode;
use App\Traits\HasClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory, SoftDeletes, HasCnpj, HasPhone, HasZipCode, HasClient;

    protected $fillable = [
        'client_id',
        'name',
        'alias',
        'email',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'cnpj',
        'phone',
        'logo',
        'site',
        'is_active',
        'grade_flow',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'grade_flow' => 'array',
    ];

    // Relacionamentos
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function coordinators(): HasMany
    {
        return $this->hasMany(Coordinator::class);
    }

    public function professors(): HasMany
    {
        return $this->hasMany(Professor::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
