<?php

namespace App;

class ValidadorEntrada
{

    private int $numero_casos;
    private array $entrada;

    function __construct(int $numero_casos, $entrada)
    {
        $this->$numero_casos = $numero_casos;
        $this->entrada = $entrada;
    }

    public function validarNumeroDeCasos(): void
    {
        if ($this->numero_casos < 1 || $this->numero_casos > 100) {
            throw "Numero de cassos Informado é menor que 1 ou maior que 100\n";
        }
    }

    public function validarSilhuetas($entrada) {
        for ($i=0; $i < count($entrada); $i+=2) { 
            $this->contarElementosSilhueta($entrada[$i + 1][0],  (int) $entrada[$i][0]);
        }
    }
    
    private function contarElementosSilhueta(string $silhueta, int $quantidade_elementos)
    {
        preg_match_all('/[0-9]{1,}/', $silhueta, $resultado);
        if (count($resultado[0]) !== $quantidade_elementos) {
            throw "Silhueta com quantidade de de elementos incorreta!";
        }
    }

    public function validarArrayNumerico(): void
    {
        foreach ($this->entrada as $value) {
            $this->entradaNumerica($value);
        }
    }

    private function entradaNumerica(string $entrada): void
    {
        preg_match('/[^0-9 ]/', $entrada, $resultado);
        if (!empty($resultado)) {
            throw "Erro: O arquivo contem valores invalidos!";
        }
    }

    public function validarQuantidadeCasos(): void
    {
        if ((count($this->entrada) / 2) === $this->numero_casos) {
            throw "Erro: Numero de casos informado esta diferente da quantidade de cassos!";
        }
    }
}
