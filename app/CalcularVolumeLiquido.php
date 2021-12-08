<?php

namespace App;

class CalcularVolumeLiquido extends EntradaDados
{

    private int $tamanho;
    private array $silhuetas;

    public function __construct()
    {
    }

    private function processarResultados(): array
    {
        $resultados = [];

        for ($i = 0; $i < $this->tamanhoArrayCasos(); $i += 2) {
            $this->tamanho = $this->entrada[$i];
            $this->silhuetas = $this->entrada[$i + 1];
            array_push($resultados, $this->calcularPreenchimentoCaso());
        }

        return $resultados;
    }

    public function imprimirResultado(array $resultados)
    {
        foreach ($resultados as $key => $value) {
            echo $value . "\n";
        }
    }

    private function calcularPreenchimentoCaso(): int
    {
        $indice_topo = $this->encontraPosicaoTopo();

        if ($indice_topo === 0) {
            return $this->contarQuantidadeAgua($this->calcularEspacoAgua($this->InverterSilhuetas($this->silhuetas)));
        } else if ($indice_topo === $this->tamanho - 1) {
            return $this->contarQuantidadeAgua($this->calcularEspacoAgua($this->silhuetas));
        } else {
            $silhuetasArray = $this->separarSilhuetasTopo($indice_topo);
            $resultado = $this->contarQuantidadeAgua($this->calcularEspacoAgua($silhuetasArray[0]));
            $calculo_reverso = $this->calcularEspacoAgua($this->InverterSilhuetas($silhuetasArray[1]));
            $resultado +=  $this->contarQuantidadeAgua($calculo_reverso);
            return $resultado;
        }
    }

    private function calcularEspacoAgua(array $silhuetas): array
    {
        $matriz_agua = null;
        $topo = 0;
        $this->topo = $silhuetas[0];

        foreach ($silhuetas as $key => $silhueta) {

            if ($topo < $silhueta) $topo = $silhueta;

            if ($topo > $silhueta) {
                $matriz_agua[$key] = array($topo, $topo - $silhueta);
                continue;
            }
            $matriz_agua[$key] = array($topo, 0);
        }
        return $matriz_agua;
    }

    private function encontraPosicaoTopo(): int
    {
        $indice = 0;
        $topo = 0;
        foreach ($this->silhuetas as $key => $silhueta) {
            if ($topo <= $silhueta) {
                $topo = $silhueta;
                $indice = $key;
            }
        }
        return $indice;
    }

    private function contarQuantidadeAgua(array $silhuetas): int
    {
        $soma = 0;
        foreach ($silhuetas as $value) {
            $soma += $value[1];
        }
        return $soma;
    }

    private function separarSilhuetasTopo(int $indice): array
    {
        $matriz = [];
        $matriz_invertida = [];
        foreach ($this->silhuetas as $key => $value) {
            if ($key >= $indice) {
                array_push($matriz_invertida, $value);
                continue;
            }
            array_push($matriz, $value);
        }

        return [$matriz, $matriz_invertida];
    }

    private function inverterSilhuetas(array $silhuetas): array
    {
        return array_reverse($silhuetas);
    }
}
