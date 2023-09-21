<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\bo\DBC;

/**
 * Controle para o DBC
 * @author Ronneesley
 */
class DBCControle extends ControleBase {
    public function processar($acao){
        switch ($acao){
            case "novo":
                $this->mostrarConfiguracaoInicial();
                break;
            case "montar_quadro":
                $this->montarQuadro();
                break;
            case "calcular":
                $this->calcular();
                break;
        }
    }

    public function mostrarConfiguracaoInicial(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dbc/novo.html");
    }

    public function montarQuadro(){
        $I = $_POST["n_tratamentos"];
        $J = $_POST["n_blocos"];

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dbc/quadro.html", 
            [ "I" => $I, "J" => $J ]);
    }

    function formatarNumero($numero, $digitos = 2){
        return strtr( number_format($numero, $digitos) , ".", ",");
    }

    public function calcular(){    
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
        
        $J = $_REQUEST["n_blocos"];        
    
        $dbc = new DBC();
        $dbc->calcular($tratamentos, $leituras, $J);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dbc/dbc.html", 
            [ "dbc" => $dbc ]);
    }
}

?>