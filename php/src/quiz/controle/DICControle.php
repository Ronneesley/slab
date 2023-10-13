<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\bo\DIC;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Controle para as funções integradas ao R
 * @author Ronneesley Moura Teles
 */
class DICControle extends DelineamentosControle {
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
        $this->mostrarPaginaLayout($layout, "dic/novo.html");
    }

    public function montarQuadro(){
        $I = $_POST["n_tratamentos"];
        $J = $_POST["n_repeticoes"];

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dic/quadro.html", 
            [ "I" => $I, "J" => $J ]);
    }

    public function calcular(){    
        $tratamentos = $_REQUEST["tratamentos"];
        $leiturasString = $_REQUEST["leituras"];
        $J = $_REQUEST["n_repeticoes"];
        
        $leituras = $this->formatarLeituras($leiturasString);
    
        $this->calcularDIC($tratamentos, $leituras, $J);
    }

    public function calcularDIC($tratamentos, $leituras, $J){
        $dic = new DIC();
        $dic->calcular($tratamentos, $leituras, $J);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "dic/dic.html", 
            [ "dic" => $dic ]);
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
        
        $this->calcularDIC($json->tratamentos, $json->leituras, $json->J);
    }
}
?>