<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasActiveScope
{
    /**
     * Scope para filtrar apenas registros ativos
     */
    public function scopeActive(Builder $query, $active = true): Builder
    {
        return $query->where('is_active', $active);
    }
}
