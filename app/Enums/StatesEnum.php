<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StatesEnum: string implements HasLabel
{
    case AC = 'AC';
    case AL = 'AL';
    case AM = 'AM';
    case AP = 'AP';
    case BA = 'BA';
    case CE = 'CE';
    case DF = 'DF';
    case ES = 'ES';
    case GO = 'GO';
    case MA = 'MA';
    case MT = 'MT';
    case MS = 'MS';
    case MG = 'MG';
    case PA = 'PA';
    case PB = 'PB';
    case PR = 'PR';
    case PE = 'PE';
    case PI = 'PI';
    case RJ = 'RJ';
    case RN = 'RN';
    case RO = 'RO';
    case RR = 'RR';
    case RS = 'RS';
    case SC = 'SC';
    case SE = 'SE';
    case SP = 'SP';
    case TO = 'TO';

    public function getLabel(): string
    {
        return match ($this) {
            self::AC => 'Acre',
            self::AL => 'Alagoas',
            self::AM => 'Amazonas',
            self::AP => 'Amapá',
            self::BA => 'Bahia',
            self::CE => 'Ceará',
            self::DF => 'Distrito Federal',
            self::ES => 'Espírito Santo',
            self::GO => 'Goiás',
            self::MA => 'Maranhão',
            self::MT => 'Mato Grosso',
            self::MS => 'Mato Grosso do Sul',
            self::MG => 'Minas Gerais',
            self::PA => 'Pará',
            self::PB => 'Paraíba',
            self::PR => 'Paraná',
            self::PE => 'Pernambuco',
            self::PI => 'Piauí',
            self::RJ => 'Rio de Janeiro',
            self::RN => 'Rio Grande do Norte',
            self::RO => 'Rondônia',
            self::RR => 'Roraima',
            self::RS => 'Rio Grande do Sul',
            self::SC => 'Santa Catarina',
            self::SE => 'Sergipe',
            self::SP => 'São Paulo',
            self::TO => 'Tocantins',
        };
    }
}