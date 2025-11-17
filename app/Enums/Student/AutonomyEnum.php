<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os níveis de autonomia do estudante
 */
enum AutonomyEnum: string implements HasLabel
{
    case DoesAlone = 'does_alone';
    case DoesIfDirected = 'does_if_directed';
    case OnlyWithSupport = 'only_with_support';
    case DoesNot = 'does_not';

    /**
     * Retorna o label em português para o nível de autonomia
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::DoesAlone => 'Faz sozinho',
            self::DoesIfDirected => 'Faz se for direcionado',
            self::OnlyWithSupport => 'Só faz com apoio',
            self::DoesNot => 'Não faz',
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
