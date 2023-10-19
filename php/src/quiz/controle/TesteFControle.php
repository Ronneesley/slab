<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\bo\Estatistica;
use QuizEstatistico\modelo\bo\TesteF;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Controle para o teste F
 * @author Ronneesley Moura Teles
 */
class TesteFControle extends ControleBase {    
    public function processar($acao){
        if ($this->estaLogado()){
            switch ($acao){
                case "novo_teste":
                    $this->novoTeste();
                    break;
                case "calcular":
                    $this->calcular();
                    break;
            }
        }else{
            $p = new PrincipalControle();
            $p->mostrarPaginaLogin("Faça login primeiro!");
        }
    }

    public function novoTeste(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/teste_f/novo.html");
    }

    public function calcular(){
        //$sA = $_REQUEST["amostra_a"];
        //$sB = $_REQUEST["amostra_b"];

        $A = $_REQUEST["amostra_a"];
        //$B = explode(";", $sB);
        $B = $_REQUEST["amostra_b"];

        $estatistico = new Estatistica();
        $mediaA = $estatistico->calcularMedia($A);
        $varianciaA = $estatistico->calcularVariancia($A);

        $mediaB = $estatistico->calcularMedia($B);
        $varianciaB = $estatistico->calcularVariancia($B);

        $testeF = new TesteF();
        $fCalculado = $testeF->calcular($B, $A);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/teste_f/resultado.html",
            ["mediaA" => $mediaA, "varianciaA" => $varianciaA,
             "mediaB" => $mediaB, "varianciaB" => $varianciaB,
             "fCalculado" => $fCalculado]);
    }
}
?>
