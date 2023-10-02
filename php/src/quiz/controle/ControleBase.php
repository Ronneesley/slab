<?php
namespace QuizEstatistico\controle;

use Twig\Extra\Intl\IntlExtension;

abstract class ControleBase {
    public abstract function processar($acao);
    
    protected function configurarTemplate($arquivo){
        $loader = new \Twig\Loader\FilesystemLoader("./templates");
        $tp = new \Twig\Environment($loader);
        $tp->addExtension(new IntlExtension());
        $pagina = $tp->load($arquivo);
        
        return $pagina;
    }
    
    protected function mostrarPagina($pagina, $parametros = array()){
        $parametros["JS_DIR"] = "./node_modules/";
        $parametros["CSS_DIR"] = "./css/";
        echo $pagina->render($parametros);
    }
    
    protected function mostrarPaginaLayout($layout, $arquivoPagina, $parametros = array()){
        $parametros["pagina"] = $arquivoPagina;
        $parametros["JS_DIR"] = "./node_modules/";
        $parametros["CSS_DIR"] = "./css/";
        
        echo $layout->render($parametros);
    }
}
?>