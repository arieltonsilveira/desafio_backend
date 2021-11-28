<?php

class CacularAgua {

  private $tamanho;
  private $silhuetas = array();
  private $valores_entrada; 
  private $numero_casos;

  public function __construct()
  {
    $data = $this->carregarDados();
    $this->numero_casos = (int) $data[0];
    $tamanho = $this->numero_casos * 2;
    array_splice($data, 0, 1);
    for ($i=0; $i < $tamanho; $i+=2) { 
      $this->valores_entrada[$i] = (int) $data[$i];
      $this->valores_entrada[$i+1] = array_map('intval', explode(' ', $data[$i+1]));
    }
  }

  public function Imprimir() {
    $resultados = [];
    $tamanho = $this->numero_casos * 2;
    for ($i=0; $i < $tamanho; $i+=2) { 
      $this->tamanho = $this->valores_entrada[$i];
      $this->silhuetas = $this->valores_entrada[$i+1];
      array_push($resultados, $this->CalcularPreenchimentoCaso());
    }

    foreach ($resultados as $key => $value) {
      echo $value . "\n";
    }
  }

  public function CalcularPreenchimentoCaso() : int {
    $result = 0;
    $indice_topo = $this->encontraPosicaoTopo();
    
    if ($indice_topo === 0) {
      $result = $this->contarQuantidadeAgua($this->calcularEspacoAgua($this->InverterSilhuetas($this->silhuetas)));
      
    } else if ($indice_topo === $this->tamanho - 1) {
      $result = $this->contarQuantidadeAgua($this->calcularEspacoAgua($this->silhuetas));

    } else {
      $silhuetasArray = $this->separarSilhuetasTopo($indice_topo);
      $result = $this->contarQuantidadeAgua($this->calcularEspacoAgua($silhuetasArray[0]));
      $calculo_reverso = $this->calcularEspacoAgua($this->InverterSilhuetas($silhuetasArray[1]));
      $result +=  $this->contarQuantidadeAgua($calculo_reverso);

    }
    
    return $result;
  }

  function carregarDados() : array {
    $arquivo = fopen ('entrada.txt', 'r');
    $entrada = array();
  
    while(!feof($arquivo)){
      $entrada[] = fgets($arquivo);
    }
  
    fclose($arquivo); 
    return $entrada;
  }

  public function calcularEspacoAgua(array $silhuetas) : array {
    $matriz_agua = null;
    $topo = 0;
    $this->topo = $silhuetas[0];

    foreach ($silhuetas as $key => $silhueta) {

      if ($topo < $silhueta) $topo = $silhueta;
      
      if ($topo > $silhueta) {
        $matriz_agua[$key] = array($topo, $topo - $silhueta);

      } else {
        $matriz_agua[$key] = array($topo, 0);

      }
    }

    return $matriz_agua;
  }

  public function encontraPosicaoTopo() : int {
    $indice = 0;
    $topo = $this->silhuetas[0];
    foreach ($this->silhuetas as $key => $silhueta) {
      if ($topo <= $silhueta) {
        $topo = $silhueta;
        $indice = $key;
      }
    }

    return $indice;
  }

  public function contarQuantidadeAgua(array $silhuetas) : int {
    $soma = 0;
    
    foreach ($silhuetas as $key => $value) {
      $soma += $value[1];
    }
    return $soma;
  }

  public function separarSilhuetasTopo (int $indice) : array {
    $matriz = [];
    $matriz_invertida = [];
    foreach ($this->silhuetas as $key => $value) {
      if ($key >= $indice) {
        array_push($matriz_invertida, $value);
      } else {
        array_push($matriz, $value);
      }
    }
    
    return [$matriz, $matriz_invertida];
  }

  public function InverterSilhuetas(array $silhuetas) : array {
    return array_reverse($silhuetas);
  }

}

$calculo = new CacularAgua();
$calculo->Imprimir();