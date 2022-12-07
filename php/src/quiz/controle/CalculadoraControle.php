<?php

namespace QuizEstatistico\controle;

/**
 * Controle para as funções integradas ao R
 * @author Ronneesley
 */
class CalculadoraControle extends ControleBase {
    public function processar($acao){
        switch ($acao){
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
            case "mostrar_calculo_desvio_amostral":
                $this->mostrarCalculadoraDesvioAmostral();
                break;
            case "mostrar_calculo_desvio_populacional":
                $this->mostrarCalculadoraDesvioPopulacional();
                break;
            case "mostrar_calculo_coeficiente_variacao_amostral":
                $this->mostrarCalculadoraCoeficienteVariacaoAmostral();
                break;
            case "mostrar_calculo_coeficiente_variacao_populacional":
                $this->mostrarCalculadoraCoeficienteVariacaoPopulacional();
                break;
            case "mostrar_calculo_variancia_amostral":
                $this->mostrarCalculadoraVarianciaAmostral();
                break;
            case "mostrar_calculo_variancia_populacional":
                $this->mostrarCalculadoraVarianciaPopulacional();
                break;
            case "calcular_media":
                $this->calcularMedia();
                break;
            case "calcular_mediana":
                $this->calcularMediana();
                break;
            case "calcular_moda":
                $this->calcularModa();
                break;
            case "calcular_amplitude":
                $this->calcularAmplitude();
                break;
            case "calcular_variancia_amostral":
                $this->calcularVarianciaAmostral();
                break;
            case "calcular_variancia_populacional":
                $this->calcularVarianciaPopulacional();
                break;
            case "calcular_desvio_amostral":
                $this->calcularDesvioAmostral();
                break;
            case "calcular_desvio_populacional":
                $this->calcularDesvioPopulacional();
                break;    
            case "calcular_coeficiente_variacao_amostral":
                $this->calcularCoeficienteAmostral();
                break;      
            case "calcular_coeficiente_variacao_populacional":
                $this->calcularCoeficientePopulacional();
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
    
    public function calcularMediana(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("mediana.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "median(conjunto)");
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraMediana($valores, $resultado, $mensagem);        
    }    

    public function calcularModa(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("moda.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "moda <- function(v) { \n");
            fwrite($arquivo, "uniqv <- unique(v) \n");
            fwrite($arquivo, "uniqv[which.max(tabulate(match(v, uniqv)))] \n");
            fwrite($arquivo, "} \n");
            fwrite($arquivo, "moda(conjunto) \n");    
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraModa($valores, $resultado, $mensagem);        
    }      
  

    public function calcularAmplitude(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("amplitude.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "max(conjunto) - min(conjunto) \n");    
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraAmplitude($valores, $resultado, $mensagem);        
    } 
  
  
     public function calcularVarianciaAmostral(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("variancia_amostral.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "var(conjunto) \n");    
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraVarianciaAmostral($valores, $resultado, $mensagem);        
    } 
 
      public function calcularVarianciaPopulacional(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("variancia_populacional.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "variancia_populacional <- function(x){ \n");    
            fwrite($arquivo, "n <- length(x) \n");    
            fwrite($arquivo, "var(x)*(n-1)/n \n");    
            fwrite($arquivo, "} \n");    
            fwrite($arquivo, "variancia_populacional(conjunto) \n");    
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraVarianciaPopulacional($valores, $resultado, $mensagem);        
    } 
 
 
       public function calcularDesvioAmostral(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("desvio_amostral.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "sd(conjunto) \n");       
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraDesvioAmostral($valores, $resultado, $mensagem);        
    } 
    

       public function calcularDesvioPopulacional(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("desvio_populacional.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "desvio_populacional <- function(x){ \n");       
            fwrite($arquivo, "n <- length(x) \n");       
            fwrite($arquivo, "a <- var(x)*(n-1)/n  \n");       
            fwrite($arquivo, "sqrt(a) \n");       
            fwrite($arquivo, "} \n");       
            fwrite($arquivo, "desvio_populacional(conjunto) \n");       
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraDesvioPopulacional($valores, $resultado, $mensagem);        
    } 


       public function calcularCoeficienteAmostral(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("coeficiente_amostral.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "sd((conjunto) / mean(conjunto)) * 100.0 \n");              
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraCoeficienteVariacaoAmostral($valores, $resultado, $mensagem);        
    } 
    
    public function mostrarCalculadoraMedia($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/media.html", 
                ["valores" => $valores, "resultado" => $resultado,
                 "mensagem" => $mensagem]);
    }
  
       public function calcularCoeficientePopulacional(){
        $valores = $_POST["valores"];
        
        $valores_tratados = str_replace(",", ".", $valores);
        $valores_tratados = str_replace(";", ",", $valores_tratados);
        
        $dadosArquivo = $this->criarArquivoTemporario("coeficiente_populacional.R");
        $arquivo = $dadosArquivo[0];
        $path_arquivo = $dadosArquivo[1];
        $nomeArquivoGerado = $dadosArquivo[2];
        
        if ($arquivo){
            fwrite($arquivo, "conjunto <- c($valores_tratados)\n");
            fwrite($arquivo, "desvio_populacional <- function(x){ \n");       
            fwrite($arquivo, "n <- length(x) \n");       
            fwrite($arquivo, "a <- var(x)*(n-1)/n  \n");       
            fwrite($arquivo, "sqrt(a) \n");       
            fwrite($arquivo, "} \n"); 
            fwrite($arquivo, "(desvio_populacional(conjunto) / mean(conjunto) * 100.0)");
            fclose($arquivo);

            $retorno = $this->executarArquivoR($nomeArquivoGerado);
            
            $resultado = ltrim($retorno[0], '[1]');
            
            $mensagem = "";
        } else {
            $mensagem = "Falha ao criar o arquivo temporário";
            
        }

        $this->mostrarCalculadoraCoeficienteVariacaoPopulacional($valores, $resultado, $mensagem);        
    }   
    
    
    public function mostrarCalculadoraMediana($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/mediana.html", 
                ["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]);
    }
    
    
    public function mostrarCalculadoraModa($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/moda.html", 
                ["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]);
    }
    
    public function mostrarCalculadoraAmplitude($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/amplitude.html", 
                ["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]);
    }
    
    public function mostrarCalculadoraVarianciaAmostral($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/variancia_amostral.html",
				["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]);
    }
    
    public function mostrarCalculadoraVarianciaPopulacional($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/variancia_populacional.html",
				["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]);
    }        
    
    public function mostrarCalculadoraDesvioAmostral($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/desvio_amostral.html", 
				["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]);   
                 }
    
    public function mostrarCalculadoraDesvioPopulacional($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/desvio_populacional.html", 
				["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]);    
                }
        
    
    
    public function mostrarCalculadoraCoeficienteVariacaoAmostral($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/coeficiente_variacao_amostral.html", 
				["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]); 
                    }

    public function mostrarCalculadoraCoeficienteVariacaoPopulacional($valores = "", $resultado = "", $mensagem = ""){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/coeficiente_variacao_populacional.html", 
				["valores" => $valores, "resultado" => $resultado,
                "mensagem" => $mensagem]); 
                    }  
  
  
    
    public function mostrarOpcoes(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/opcoes.html");
    }
}

?>
