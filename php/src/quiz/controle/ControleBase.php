<?php
namespace QuizEstatistico\controle;

abstract class ControleBase {    
    protected function configurarTemplate($arquivo){
        $loader = new \Twig\Loader\FilesystemLoader("./templates");
        $tp = new \Twig\Environment($loader);
        $pagina = $tp->load($arquivo);
        
        return $pagina;
    }
    
    protected function mostrarPagina($pagina, $parametros = array()){
        echo $pagina->render($parametros);
    }
    
    protected function mostrarPaginaLayout($layout, $arquivoPagina, $parametros = array()){
        $parametros["pagina"] = $arquivoPagina;
        $parametros["JS_DIR"] = "./node_modules/";
        
        echo $layout->render($parametros);
    }
}
?>