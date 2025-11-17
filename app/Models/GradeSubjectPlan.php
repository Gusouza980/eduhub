<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model para representar os planos de aula de uma matéria por bimestre
 * Cada plano é vinculado a uma GradeSubject (matéria de uma série em uma escola)
 */
class GradeSubjectPlan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Os atributos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'grade_subject_id',
        'bimester',
        'observations',
        'file_path',
        'is_active',
    ];

    /**
     * Define os casts para os atributos do modelo
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'bimester' => 'integer',
        ];
    }

    /**
     * Define os atributos customizados que serão retornados automaticamente
     */
    protected function appends(): array
    {
        return ['bimester_name'];
    }

    /**
     * Relacionamento com a matéria da grade
     */
    public function gradeSubject(): BelongsTo
    {
        return $this->belongsTo(GradeSubject::class);
    }

    /**
     * Retorna o nome formatado do bimestre
     */
    public function getBimesterNameAttribute(): string
    {
        return "{$this->bimester}º Bimestre";
    }

    /**
     * Verifica se o plano tem um arquivo válido
     */
    public function hasFile(): bool
    {
        return ! empty($this->file_path) && file_exists(storage_path('app/'.$this->file_path));
    }
}
