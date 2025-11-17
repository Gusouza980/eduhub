<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os níveis de suporte do estudante
 */
enum SupportLevelEnum: string implements HasLabel
{
    case Low = 'low';
    case Moderate = 'moderate';
    case High = 'high';

    /**
     * Retorna o label em português para o nível de suporte
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Low => 'Baixo',
            self::Moderate => 'Moderado',
            self::High => 'Alto',
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
