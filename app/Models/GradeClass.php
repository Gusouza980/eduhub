<?php

namespace App\Models;

use App\Enums\Student\StudentShiftEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradeClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'grade_id',
        'name',
        'year',
        'shift',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'year' => 'integer',
            'shift' => StudentShiftEnum::class,
        ];
    }

    protected $appends = ['full_name'];

    // Relacionamentos
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    // Custom attributes
    public function getFullNameAttribute(): string
    {
        $shiftLabel = $this->shift?->getLabel() ?? '';

        return $this->grade->name.' - '.$this->name.' ('.$shiftLabel.') - '.$this->year;
    }
}
