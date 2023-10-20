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
        
        if ($varA === 0 || $varB === 0) {
            echo "Não é possível calcular o F, pois não existe variância em um dos grupos.";
        } else {
            return $varA / $varB;
        }
    }
}
?>
