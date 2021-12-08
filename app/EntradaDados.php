<?php

namespace App;

use Exception;

class EntradaDados
{
    private string $caminho_arquivo;

    public function __construct(string $caminho_arquivo)
    {
        $this->caminho_arquivo = $caminho_arquivo;
    }

    /*
     * @throws Exception
     */
    public function lerArquivo(): array
    {
        $this->verificaSeArquivoValido();

        $arquivo = fopen($this->caminho_arquivo, 'r');

        $entrada = array();

        while (!feof($arquivo)) {
            $entrada[] = fgets($arquivo);
        }

        fclose($arquivo);

        return $entrada;
    }

    /*
     * @throws Exception
     */
    private function verificaSeArquivoValido()
    {
        if (!is_readable($this->caminho_arquivo)) {
            throw new Exception("Arquivo não existe ou não pode ser lido!");
        }
    }
}
