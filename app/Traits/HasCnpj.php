<?php

namespace App\Traits;

trait HasCnpj
{
    public function setCnpjAttribute(?string $value): void
    {
        if ($value) {
            $this->attributes['cnpj'] = clearString($value);
        }
    }

    public function getCnpjAttribute(?string $value): ?string
    {
        return $value ? formatCnpj($value) : null;
    }
}

