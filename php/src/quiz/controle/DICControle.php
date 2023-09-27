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

    function formatarNumero($numero, $digitos = 2){
        return strtr( number_format($numero, $digitos) , ".", ",");
    }

    function formatarLeituras($leiturasString){
        $leituras = array();
        for ($i = 0; $i < count($leiturasString); $i++){
            $ts = array();
            
            for ($j = 0; $j < count($leiturasString[$i]); $j++){                
                $valorConvertido = floatval(str_replace(",", ".", $leiturasString[$i][$j]));
                
                array_push($ts, $valorConvertido);
            }
            
            array_push($leituras, $ts);
        }

        return $leituras;
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