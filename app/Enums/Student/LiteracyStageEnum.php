<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os estágios de alfabetização do estudante
 */
enum LiteracyStageEnum: string implements HasLabel
{
    case PreSyllabic = 'pre_syllabic';
    case Syllabic = 'syllabic';
    case SyllabicAlphabetic = 'syllabic_alphabetic';
    case Alphabetic = 'alphabetic';

    /**
     * Retorna o label em português para o estágio de alfabetização
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::PreSyllabic => 'Pré-silábico',
            self::Syllabic => 'Silábico',
            self::SyllabicAlphabetic => 'Silábico-alfabético',
            self::Alphabetic => 'Alfabético',
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
