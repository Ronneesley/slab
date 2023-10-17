<?php
namespace QuizEstatistico\controle;

use Twig\Extra\Intl\IntlExtension;

session_start();

abstract class ControleBase {
    public abstract function processar($acao);

    function formatarNumero($numero, $digitos = 2){
        return strtr( number_format($numero, $digitos) , ".", ",");
    }

    function converterNumero($leitura){
        return floatval(str_replace(",", ".", $leitura));
    }

    function converterNumeroVetor($vetor){
        $ns = array();

        for ($i = 0; $i < count($vetor); $i++){
            array_push($ns, $this->converterNumero($vetor[$i]));
        }

        return $ns;
    }

    function obterPostNumero($nome){
        return $this->converterNumero($_POST[$nome]);
    }

    function obterPostInteiro($nome){
        return intval($_POST[$nome]);
    }
    
    protected function configurarTemplate($arquivo){
        $loader = new \Twig\Loader\FilesystemLoader("./templates");
        $tp = new \Twig\Environment($loader);
        $tp->addExtension(new IntlExtension());
        $pagina = $tp->load($arquivo);
        
        return $pagina;
    }

    protected function estaLogado(){
        return isset($_SESSION["usuario"]);
    }

    protected function configurarVariaveis(& $parametros){
        if ($this->estaLogado()) {
            $parametros["usuario"] = $_SESSION["usuario"];
        } 

        $parametros["NODE_DIR"] = "./node_modules/";
        
        $parametros["CSS_DIR"] = "./css/";
        $parametros["JS_DIR"] = "./js/";
    }
    
    protected function mostrarPagina($pagina, $parametros = array()){
        $this->configurarVariaveis($parametros);
        echo $pagina->render($parametros);
    }
    
    protected function mostrarPaginaLayout($layout, $arquivoPagina, $parametros = array()){
        $parametros["pagina"] = $arquivoPagina;
        $this->configurarVariaveis($parametros);

        /*print("<pre>");
        print_r($parametros);
        print("</pre>");*/

        echo $layout->render($parametros);
    }
}
?>