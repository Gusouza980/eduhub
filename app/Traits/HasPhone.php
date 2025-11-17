<?php

namespace App\Traits;

trait HasPhone
{
    public function setPhoneAttribute(?string $value): void
    {
        if ($value) {
            $this->attributes['phone'] = clearString($value);
        }
    }

    public function getPhoneAttribute(?string $value): ?string
    {
        return $value ? formatPhone($value) : null;
    }
}

