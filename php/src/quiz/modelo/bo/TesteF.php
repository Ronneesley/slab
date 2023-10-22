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
            return "O teste F não pode ser calculado quando não há variabilidade em um dos grupos.";
        }

        $var = $varA / $varB;

        
        if(abs($var) < 0.01) {
            $varFormatadoNotacao = sprintf("%.2e", $var);
            list($base, $exponent) = explode("e", $varFormatadoNotacao);
            $base2 = number_format($base, 2, ',', '.');
            $varFormatadoNotacaoFinal = $base2 . " x 10^" . $exponent;
            return $varFormatadoNotacaoFinal;

        } else{
            $varFormatado = number_format($var, 2, ',', '.');
            return $varFormatado;
        }
    }
}
?>
