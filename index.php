<?php
require __DIR__ . '/vendor/autoload.php';

use App\CalcularVolumeLiquido;
use App\ConverteEntrada;
use App\EntradaDados;
use App\ValidadorEntrada;

$arquivo = __DIR__ . "/entrada.txt";

try {
    $entrada = new EntradaDados($arquivo);
    $dados = $entrada->lerArquivo();

    $validacao = new ValidadorEntrada($dados);
    $validacao->executar();

    $converte = new ConverteEntrada($dados);
    $calcular = new CalcularVolumeLiquido($converte->executar());
    $calcular->imprimirResultado();
} catch (Exception $exeption) {
    echo $exeption->getMessage();
}
