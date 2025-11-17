<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasClient
{
    /**
     * Scope para filtrar registros por cliente
     */
    public function scopeFromClient(Builder $query, $clientId = null): Builder
    {
        if(!$clientId) {
            $clientId = getClientId();
        }

        return $query->where('client_id', $clientId);
    }
}
