<?php

namespace App\Traits;

trait HasRandomKey
{
    /**
     * Key aleatória para forçar rerrenderização de componentes filhos
     */
    public string $randomKey = '';

    /**
     * Inicializa a key aleatória ao montar o componente
     */
    public function mountHasRandomKey(): void
    {
        $this->randomKey = $this->generateRandomKey();
    }

    /**
     * Gera uma nova key aleatória
     */
    public function generateRandomKey(): string
    {
        return uniqid('key_', true);
    }

    /**
     * Regenera a key aleatória (forçando rerrenderização de componentes filhos)
     */
    public function regenerateKey(): void
    {
        $this->randomKey = $this->generateRandomKey();
    }
}
