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
            case "mostrar_calculo_amplitude":
                $this->mostrarCalculadoraAmplitude();
                break;
            case "mostrar_calculo_moda":
                $this->mostrarCalculadoraModa();
                break;
            case "mostrar_calculo_desvio":
                $this->mostrarCalculadoraDesvio();
                break;
            case "mostrar_calculo_coeficiente_variacao":
                $this->mostrarCalculadoraCoeficienteVariacao();
                break;
            case "mostrar_calculo_variancia":
                $this->mostrarCalculadoraVariancia();
                break;
            case "calcular_media":
                $this->calcularMedia();
                break;
            case "opcoes":
                $this->mostrarOpcoes();
                break;
        }        
    }
    
    public function criarArquivoTemporario($nome){
        $diretorioTemporario = "./tmp/";
        $path_arquivo = $diretorioTemporario . "/" . $nome;
        $arquivo = fopen($path_arquivo, "w+");
        
        $nomeArquivoGerado = $nome;
        
        return [$arquivo, $path_arquivo, $nomeArquivoGerado];
    }
    
    public function executarArquivoR($nome){
        //exec("Rscript " . $path_arquivo, $retorno);
        exec(".\\tmp\\" . $nome, $retorno);
        
        return $retorno;
    }
    
    public function calcularMedia(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("media.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "mean(conjunto)");
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
        }

        $this->mostrarCalculadoraMedia($valores, $resultado, $mensagem);        
    }
    
    public function mostrarCalculadoraMedia($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/media.html", 
                ["valores" => $valores, "resultado" => $resultado,
                 "mensagem" => $mensagem]);
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

    public function mostrarCalculadoraModa($valores = "", $resultado = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/moda.html", 
                ["valores" => $valores, "resultado" => $resultado]);
    }

    public function mostrarCalculadoraAmplitude($valores = "", $resultado = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/amplitude.html", 
                ["valores" => $valores, "resultado" => $resultado]);
    }

    public function mostrarCalculadoraDesvio($valores = "", $resultado = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/desvio.html", 
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

    public function mostrarCalculadoraVariancia(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/variancia.html");
    }
}

?>
