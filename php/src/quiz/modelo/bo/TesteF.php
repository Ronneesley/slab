<?php
namespace QuizEstatistico\modelo\bo;

class TesteF {
    /**
     * Calcula o F calculado
     */
    public function calcular($A, $B){
        $estatistico = new Estatistica();

        $varA = $estatistico->calcularVariancia($A);
        $varB = $estatistico->calcularVariancia($B);

        return $varA / $varB;
    }
}
?>