<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\bo\DBC;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Controle para o DBC
 * @author Ronneesley Moura Teles
 */
class DBCControle extends DelineamentosControle {
    public function processar($acao){
        if ($this->estaLogado()){
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
                case "salvar_dados":
                    $this->salvarDados();
                    break;
                case "importar":
                    $this->importar();
                    break;
            }
        }else{
            $p = new PrincipalControle();
            $p->mostrarPaginaLogin("Faça login primeiro!");
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

    public function calcular(){    
        $tratamentos = $_REQUEST["tratamentos"];
        $leiturasString = $_REQUEST["leituras"];        
        $leituras = $this->formatarLeituras($leiturasString);
        
        $J = $_REQUEST["n_blocos"];        
    
        $this->calcularDBC($tratamentos, $leituras, $J);
    }

    public function calcularDBC($tratamentos, $leituras, $J){
        $dbc = new DBC();
        $dbc->calcular($tratamentos, $leituras, $J);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dbc/dbc.html", 
            [ "dbc" => $dbc ]);
    }

    public function salvarDados(){
        $I = intval($_REQUEST["I"]);
        $J = intval($_REQUEST["J"]);
        $tratamentos = $_REQUEST["tratamentos"];
        $leiturasString = $_REQUEST["leituras"];
        $leituras = $this->formatarLeituras($leiturasString);

        $json = array(
            "I" => $I,
            "J" => $J,
            "tratamentos" => $tratamentos,
            "leituras" => $leituras
        );

        header('Content-Description: File Transfer');
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="dados.json"');
        echo json_encode($json, JSON_PRETTY_PRINT);
    }

    public function importar(){
        $path = $_FILES["arquivo"]["tmp_name"];

        $json = json_decode(file_get_contents($path));
        
        $this->calcularDBC($json->tratamentos, $json->leituras, $json->J);
    }
}

?>