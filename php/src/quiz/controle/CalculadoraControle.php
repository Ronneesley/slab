<?php

namespace QuizEstatistico\controle;

/**
 * Controle para as funções integradas ao R
 * @author Ronneesley
 */
class CalculadoraControle extends ControleBase {
    public function processar($acao){
        switch ($acao){
            case "mostrar_frequencia_relativa":
                $this->mostrarFrequenciaRelativa();
                break;
            case "mostrar_calculo_media":
                $this->mostrarCalculadoraMedia();
                break;
            case "mostrar_calculo_mediana":
                $this->mostrarCalculadoraMediana();
                break;
            case "mostrar_calculo_coeficiente_variacao":
                $this->mostrarCalculadoraCoeficienteVariacao();
                break;
            case "calcular_media":
                $this->calcularMedia();
                break;
            case "opcoes":
                $this->mostrarOpcoes();
                break;
        }        
    }
    
    public function calcularMedia(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        //$tmp = "/var/www/html/quizestatistico/php/src/tmp/";
        $arquivo = fopen("media.R", "w+");
        fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
        fwrite($arquivo, "mean(conjunto)");
        
        exec("media.R", $retorno);
        
        $resultado = ltrim($retorno[0], '[1]');
        
        fclose($arquivo);
        
        $this->mostrarCalculadoraMedia($valores, $resultado);
    }
    
    public function mostrarCalculadoraMedia($valores = "", $resultado = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/media.html", 
                ["valores" => $valores, "resultado" => $resultado]);
    }
    
    public function mostrarCalculadoraMediana($valores = "", $resultado = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/mediana.html", 
                ["valores" => $valores, "resultado" => $resultado]);
    }
    public function mostrarCalculadoraCoeficienteVariacao($valores = "", $resultado = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/coeficiente de variação.html", 
                ["valores" => $valores, "resultado" => $resultado]);
    }
    
    public function mostrarFrequenciaRelativa(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/frequencia_relativa.html");
    }
    
    public function mostrarOpcoes(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/opcoes.html");
    }
}

?>
