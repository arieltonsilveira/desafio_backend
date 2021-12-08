<?php

namespace App;

class converteEntrada {

    private int     $numero_casos;
    private array   $entrada;

    public function __construct(array $entrada)
    {
        $this->entrada = $entrada;
        $this->pegarNumeroCasos();
        $this->removerNumeroCasosEntrada();
    }

    private function pegarNumeroCasos(): void
    {
        if (!is_int($this->entrada[0])) {
            throw "Erro: Numero de casos invalido";
        }
        $this->numero_casos = $this->entrada[0];
    }

    private function removerNumeroCasosEntrada(): void
    {
        $this->entrada = array_splice($this->entrada, 0, 1);
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