<?php

class EntradaDados
{
    private $entrada;
    private $numero_casos;

    function __construct($caminho_arquivo)
    {
        $this->entrada = $this->lerArquivo($caminho_arquivo);
    }

    function lerArquivo(string $caminho_arquivo): array
    {
        try {
            if (is_readable($caminho_arquivo)) {
                throw "Erro: Arquivo não existe ou não pode ser lido!";
            }

            $arquivo = fopen($caminho_arquivo, 'r');
            $entrada = array();

            while (!feof($arquivo)) {
                $entrada[] = fgets($arquivo);
            }

            fclose($arquivo);
            return $entrada;
        } catch (\Throwable $th) {
            throw "Erro: " . $th->getMessage() . "\n";
        }
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

    private function validarNumeroDeCasos(): void
    {
        if ($this->numero_casos < 1 || $this->numero_casos > 100) {
            throw "Numero de cassos Informado é menor que 1 ou maior que 100\n";
        }
    }

    public function tamanhoArrayCasos(): int
    {
        return $this->numero_casos * 2;
    }

    private function converteEntradaEmInteiro(): void
    {
        for ($i = 0; $i < $this->tamanhoArrayCasos(); $i += 2) {
            $this->entrada[$i] = (int) $this->entrada[$i];
            $this->entrada[$i + 1] = array_map('intval', explode(' ', $this->entrada[$i + 1]));
        }
    }

    private function entradaDadosNumerica(): void
    {
        
    }

    private function validarQuantidadeCasos(): void
    {
        if (count($this->entrada) === $this->numero_casos) {
            throw "Erro: Numero de casos informado esta diferente da quantidade de cassos!";
        }
    }
}
