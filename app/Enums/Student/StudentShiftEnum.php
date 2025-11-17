<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os turnos escolares disponíveis
 */
enum StudentShiftEnum: string implements HasLabel
{
    case Morning = 'morning';
    case Afternoon = 'afternoon';

    /**
     * Retorna o label em português para o turno
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Morning => 'Manhã',
            self::Afternoon => 'Tarde',
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
