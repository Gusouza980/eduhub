<?php

namespace App\Traits;

trait HasZipCode
{
    public function setZipCodeAttribute(?string $value): void
    {
        if ($value) {
            $this->attributes['zip_code'] = clearString($value);
        }
    }

    public function getZipCodeAttribute(?string $value): ?string
    {
        return $value ? formatCep($value) : null;
    }
}

