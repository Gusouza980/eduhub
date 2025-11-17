<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os níveis de comunicação verbal do estudante
 */
enum VerbalCommunicationEnum: string implements HasLabel
{
    case Verbal = 'verbal';
    case UsesCoherentWords = 'uses_coherent_words';
    case DisconnectedSpeech = 'disconnected_speech';
    case Averbal = 'averbal';

    /**
     * Retorna o label em português para o nível de comunicação verbal
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Verbal => 'Verbal',
            self::UsesCoherentWords => 'Usa palavras coerentes',
            self::DisconnectedSpeech => 'Tem fala desconexa',
            self::Averbal => 'Averbal',
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
