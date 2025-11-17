<?php

namespace App\Models;

use App\Traits\HasDocument;
use App\Traits\HasPhone;
use App\Traits\HasZipCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Professor extends Model
{
    use HasFactory, SoftDeletes, HasDocument, HasPhone, HasZipCode;

    protected $fillable = [
        'client_id',
        'user_id',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'document',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $with = ['user'];
    protected $appends = ['name'];

    // Relacionamentos
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class, 'professor_schools', 'professor_id', 'school_id');
    }

    // Custom attributes
    public function getNameAttribute(): string
    {
        return $this->user->name;
    }
}
