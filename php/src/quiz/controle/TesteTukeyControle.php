<?php
namespace QuizEstatistico\controle;

/**
 * Controle para o teste de Tukey
 * @author Ronneesley Moura Teles
 */
class TesteTukeyControle extends ControleBase {    
    
    public function processar($acao){
        switch ($acao){
            case "novo_teste":
                $this->novoTeste();
                break;
            
        }
    }

    public function novoTeste(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "calculadora/teste_tukey/novo.html");
    }

}
?>