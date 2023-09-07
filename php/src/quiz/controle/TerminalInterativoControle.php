<?php

namespace QuizEstatistico\controle;

/**
 * Classe que gerencia o terminal interativo
 * @author roni
 */
class TerminalInterativoControle extends ControleBase {
    
    public function processar($acao) {
        switch ($acao){
            case "mostrar_terminal":
                $this->mostrarTerminal();
                break;
        }
    }
    
    public function mostrarTerminal(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "terminal_interativo/inicio.html");
    }
}

?>