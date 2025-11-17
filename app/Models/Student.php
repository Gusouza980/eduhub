<?php

namespace App\Models;

use App\Enums\Student\AutonomyEnum;
use App\Enums\Student\DiagnosisEnum;
use App\Enums\Student\LearningProfileEnum;
use App\Enums\Student\LiteracyStageEnum;
use App\Enums\Student\SocializationEnum;
use App\Enums\Student\StudentShiftEnum;
use App\Enums\Student\SupportLevelEnum;
use App\Enums\Student\VerbalCommunicationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasClient;
/**
 * Model para representar os estudantes do sistema
 * Contém informações sobre avaliação psicológica, motora e social
 */
class Student extends Model
{
    use HasFactory, SoftDeletes, HasClient;

    /**
     * Os atributos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'client_id',
        'full_name',
        'birth_date',
        'school_id',
        'grade_id',
        'shift',
        'support_level',
        'literacy_stage',
        'socialization',
        'verbal_communication',
        'autonomy',
        'concentration_time',
        'learning_profile',
        'other_relevant_info',
    ];

    /**
     * Define os casts para os atributos do modelo
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'concentration_time' => 'integer',
            'shift' => StudentShiftEnum::class,
            'support_level' => SupportLevelEnum::class,
            'literacy_stage' => LiteracyStageEnum::class,
            'socialization' => SocializationEnum::class,
            'verbal_communication' => VerbalCommunicationEnum::class,
            'autonomy' => AutonomyEnum::class,
            'learning_profile' => LearningProfileEnum::class,
        ];
    }

    /**
     * Relacionamento com a escola
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Relacionamento com a série (grade)
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Retorna a idade do estudante em anos
     */
    public function getAgeAttribute(): int
    {
        return $this->birth_date->age;
    }

    /**
     * Retorna o nome formatado do estudante
     */
    public function getFormattedNameAttribute(): string
    {
        return ucwords(strtolower($this->full_name));
    }

    /**
     * Relacionamento com os CIDs do estudante
     */
    public function cids(): BelongsToMany
    {
        return $this->belongsToMany(Cid::class, 'student_cids');
    }
}
