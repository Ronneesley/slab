<?php
namespace QuizEstatistico\modelo\bo;

class Estatistica {
    public function calcularMedia($V){
        $s = 0;
        $n = count($V);

        for ($i = 0; $i < $n; $i++){
            $s += $V[$i];
        }

        return $s / $n;
    }

    /**
     * Esta função calcula a variância de um vetor numérico V
     */
    public function calcularVariancia($V){
        $media = $this->calcularMedia($V);

        $n = count($V);
        $s = 0;

        for ($i = 0; $i < $n; $i++){
            $s += ( $V[$i] - $media ) ** 2;
        }

        return $s / ($n - 1);
    }
}
?>