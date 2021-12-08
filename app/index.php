<?php
require __DIR__ .'/vendor/autoload.php';

use App\CalcularVolumeLiquido;
use App\EntradaDados;

$arquivo = "entrada.txt";

$entrada = new EntradaDados($arquivo);
var_dump($entrada->lerArquivo());
//$calculo = new CalcularVolumeLiquido();
//$calculo->imprimirSaida();