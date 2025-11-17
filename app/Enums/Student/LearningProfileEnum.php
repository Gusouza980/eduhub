<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os perfis de aprendizagem do estudante
 */
enum LearningProfileEnum: string implements HasLabel
{
    case Visual = 'visual';
    case Auditory = 'auditory';
    case Kinesthetic = 'kinesthetic';
    case LogicalMathematical = 'logical_mathematical';

    /**
     * Retorna o label em português para o perfil de aprendizagem
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Visual => 'Visual',
            self::Auditory => 'Auditivo',
            self::Kinesthetic => 'Cinestésico',
            self::LogicalMathematical => 'Lógico-Matemático',
        };
    }

    /**
     * Retorna todos os labels em português
     */
    public static function labels(): array
    {
        return array_column(
            array_map(fn ($case) => [$case->value => $case->getLabel()], self::cases()),
            0
        );
    }
}
