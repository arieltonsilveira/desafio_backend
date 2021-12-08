<?php

namespace App;

use Exception;

class ConverteEntrada {

    private int     $numero_casos;
    private array   $entrada;

    public function __construct(array $entrada)
    {

        $this->entrada = $entrada;
        $this->numero_casos = (int) $entrada[0];
        $this->removerNumeroCasosEntrada();
    }

    private function removerNumeroCasosEntrada(): void
    {
        array_shift($this->entrada);
    }

    public function converteEntradaEmInteiro(): array
    {
        for ($i = 0; $i < $this->tamanhoArrayCasos(); $i += 2) {
            $this->entrada[$i] = (int) $this->entrada[$i];
            $this->entrada[$i + 1] = array_map('intval', explode(' ', $this->entrada[$i + 1]));
        }
        return $this->entrada;
    }

    public function tamanhoArrayCasos(): int
    {
        return $this->numero_casos * 2;
    }
}