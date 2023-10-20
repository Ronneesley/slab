<?php
namespace QuizEstatistico\modelo\bo;

class TesteF {
    /**
     * Calcula o F calculado
     */
    public function calcular($A, $B){
        $estatistico = new Estatistica();

        $varA = $estatistico->calcularVariancia($A);
        $varAFloat = (float)$varA;

        $varB = $estatistico->calcularVariancia($B);
        $varBFloat = (float)$varB;


        $resultado = $varAFloat / $varBFloat; 
        $resultadoF = number_format($resultado, 2, ',', '');

        //return $varA / $varB;
        return $resultadoF;
    }
}
?>