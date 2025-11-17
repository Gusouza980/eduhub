<?php

namespace App\Traits;

trait HasDocument
{
    public function setDocumentAttribute(string $value): void
    {
        $this->attributes['document'] = clearString($value);
    }

    public function getDocumentAttribute(?string $value): ?string
    {
        return $value ? formatDocument($value) : null;
    }
}

