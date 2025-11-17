<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradeClassStudent extends Model
{
    protected $fillable = [
        'grade_class_id',
        'student_id',
    ];

    public function gradeClass(): BelongsTo
    {
        return $this->belongsTo(GradeClass::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
