<?php

namespace App\Enums\Student;

use Filament\Support\Contracts\HasLabel;

/**
 * Enum para representar os diagnósticos dos estudantes
 */
enum DiagnosisEnum: string implements HasLabel
{
    case Autism = 'autism';
    case ADHD = 'adhd';
    case Dyslexia = 'dyslexia';
    case Dyscalculia = 'dyscalculia';
    case DownSyndrome = 'down_syndrome';
    case OppositionDefiantDisorder = 'opposition_defiant_disorder';
    case CerebralPalsy = 'cerebral_palsy';
    case IntellectualDisability = 'intellectual_disability';
    case LanguageDisorder = 'language_disorder';
    case Dysgraphia = 'dysgraphia';
    case DevelopmentalCoordinationDisorder = 'developmental_coordination_disorder';
    case VisualImpairment = 'visual_impairment';
    case HearingImpairment = 'hearing_impairment';
    case Other = 'other';

    /**
     * Retorna o label em português para o diagnóstico
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Autism => 'Autismo (TEA)',
            self::ADHD => 'TDAH',
            self::Dyslexia => 'Dislexia',
            self::Dyscalculia => 'Discalculia',
            self::DownSyndrome => 'Síndrome de Down',
            self::OppositionDefiantDisorder => 'TOD (Transtorno Opositor Desafiador)',
            self::CerebralPalsy => 'Paralisia Cerebral',
            self::IntellectualDisability => 'Deficiência Intelectual',
            self::LanguageDisorder => 'Transtorno de Linguagem',
            self::Dysgraphia => 'Disgrafia',
            self::DevelopmentalCoordinationDisorder => 'Transtorno do Desenvolvimento da Coordenação',
            self::VisualImpairment => 'Deficiência Visual',
            self::HearingImpairment => 'Deficiência Auditiva',
            self::Other => 'Outro',
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
