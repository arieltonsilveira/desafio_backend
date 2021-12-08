<?php

namespace App;

use Exception;

class ValidadorEntrada
{

    private $numero_casos;
    private array $entrada;

    function __construct(array $entrada)
    {
        $this->numero_casos = $entrada[0];
        $this->entrada = array_splice($entrada, 0, 1);
    }

    public function executar(): void
    {
        $this->validarValorDeCasos();
        $this->validarQuantidadeCasos();
        $this->validarArrayNumerico();
        $this->validarSilhuetas();
    }

    private function validarValorUnicoLinha($valor): void
    {
        preg_match_all('[0-9]{1,}', $valor, $resultado);
        if (!count($resultado) !== 1) {
            throw new Exception("Erro: Entrada numero casos ou tamanho do array invalido");
        }
    }

    private function validarValorDeCasos(): void
    {
        if ($this->numero_casos < 1 || $this->numero_casos > 100) {
            throw new Exception("Numero de cassos Informado é menor que 1 ou maior que 100\n");
        }
    }

    private function validarSilhuetas(): void
    {
        for ($i=0; $i < count($this->entrada); $i+=2) {
            $this->contarElementosSilhueta($this->entrada[$i + 1][0],  (int) $this->entrada[$i][0]);
        }
    }

    private function contarElementosSilhueta(string $silhueta, $quantidade_elementos): void
    {
        $this->validarValorUnicoLinha($quantidade_elementos);
        preg_match_all('/[0-9]{1,}/', $silhueta, $resultado);
        if (count($resultado[0]) != $quantidade_elementos) {
            throw new Exception("Silhueta com quantidade de de elementos incorreta!");
        }
    }

    private function validarArrayNumerico(): void
    {
        foreach ($this->entrada as $value) {
            $this->entradaNumerica($value);
        }
    }

    private function entradaNumerica(string $entrada): void
    {
        preg_match('/[^0-9 ]/', $entrada, $resultado);
        if (!empty($resultado)) {
            throw new Exception("Erro: O arquivo contem valores invalidos!");
        }
    }

    private function validarQuantidadeCasos(): void
    {
        if ((count($this->entrada) / 2) === $this->numero_casos) {
            throw new Exception("Erro: Numero de casos informado esta diferente da quantidade de cassos!");
        }
    }
}
