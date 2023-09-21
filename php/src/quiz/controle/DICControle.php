<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\bo\DIC;

/**
 * Controle para as funções integradas ao R
 * @author Ronneesley
 */
class DICControle extends ControleBase {
    public function processar($acao){
        switch ($acao){
            case "novo":
                $this->mostrarConfiguracaoInicialDIC();
                break;
            case "montar_quadro":
                $this->montarQuadroDIC();
                break;
            case "calcular":
                $this->calcularDIC();
                break;
        }
    }

    public function mostrarConfiguracaoInicialDIC(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dic/novo.html");
    }

    public function montarQuadroDIC(){
        $I = $_POST["n_tratamentos"];
        $J = $_POST["n_repeticoes"];

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dic/quadro.html", 
            [ "I" => $I, "J" => $J ]);
    }

    function formatarNumero($numero, $digitos = 2){
        return strtr( number_format($numero, $digitos) , ".", ",");
    }

    public function calcularDIC(){    
        $tratamentos = $_REQUEST["tratamentos"];
        $leiturasString = $_REQUEST["leituras"];
        
        $leituras = array();
        for ($i = 0; $i < count($leiturasString); $i++){
            $ts = array();
            
            for ($j = 0; $j < count($leiturasString[$i]); $j++){                
                $valorConvertido = str_replace(",", ".", $leiturasString[$i][$j]);
                
                array_push($ts, $valorConvertido);
            }
            
            array_push($leituras, $ts);
        }
        
        $J = $_REQUEST["n_repeticoes"];        
    
        $dic = new DIC();
        $dic->calcular($tratamentos, $leituras, $J);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dic/dic.html", 
            [ "dic" => $dic ]);
    }
}

?>