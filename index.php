<?php
require __DIR__ .'/vendor/autoload.php';

use App\EntradaDados;

$arquivo = "entrada.txt";

try {
    $entrada = new EntradaDados($arquivo);
    var_dump($entrada->lerArquivo());

} catch (Exception $exeption) {
    echo $exeption->getMessage();
}