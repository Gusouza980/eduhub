<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os níveis de socialização do estudante
 */
enum SocializationEnum: string implements HasLabel
{
    case Normal = 'normal';
    case FewConflicts = 'few_conflicts';
    case ManyConflicts = 'many_conflicts';
    case Aggressiveness = 'aggressiveness';

    /**
     * Retorna o label em português para o nível de socialização
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Normal => 'Normal',
            self::FewConflicts => 'Poucos Conflitos',
            self::ManyConflicts => 'Muitos Conflitos',
            self::Aggressiveness => 'Agressividade',
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
