<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\bo\TesteTukey;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Controle para o teste de Tukey
 * @author Ronneesley Moura Teles
 */
class TesteTukeyControle extends ControleBase {    
    
    public function processar($acao){
        if ($this->estaLogado()){
            switch ($acao){
                case "novo":
                    $this->mostrarConfiguracaoInicial();
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

    public function mostrarConfiguracaoInicial(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/teste_tukey/novo.html");
    }

    public function calcular(){
        $medias = $this->converterNumeroVetor(explode(";", $_POST["medias"]));
        $q = $this->obterPostNumero("q");
        $qmRes = $this->obterPostNumero("qmRes");
        $r = $this->obterPostInteiro("n_repeticoes");

        $teste = new TesteTukey();
        $teste->calcular($medias, $q, $qmRes, $r);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/teste_tukey/resultado.html",
            ["teste" => $teste]);
    }
}

?>