<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\bo\Estatistica;
use QuizEstatistico\modelo\bo\TesteF;
use QuizEstatistico\controle\PrincipalControle;
use QuizEstatistico\modelo\bo\AmplitudeTotal;

/**
 * Controle para o cálculo da amplitude total
 * @author Ronneesley Moura Teles
 */
class AmplitudeTotalControle extends ControleBase {    
    public function processar($acao){
        if ($this->estaLogado()){
            switch ($acao){
                case "studentizada_q":
                    $this->montarTabelaStudentizadaQ();
                    break;
                case "funcao_gama":
                    $this->novoCalculoGama();
                    break;
                case "calcular_gama":
                    $this->calcularGama();
                    break;
            }
        }else{
            $p = new PrincipalControle();
            $p->mostrarPaginaLogin("Faça login primeiro!");
        }
    }

    public function calcularGama(){
        $x = $_REQUEST["x"];

        $amplitudeTotal = new AmplitudeTotal();
        $gama = $amplitudeTotal->calcularGama($x);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/amplitude_total/calcular_gama.html",
            ["x" => $x, "gama" => $gama]);
    }

    public function novoCalculoGama(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/amplitude_total/calcular_gama.html");
    }

    public function montarTabelaStudentizadaQ(){
        $amplitudeTotal = new AmplitudeTotal();
        $m = $amplitudeTotal->studentizadaQ();

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/amplitude_total/studentizada_q.html",
            ["m" => $m]);
    }

}
?>