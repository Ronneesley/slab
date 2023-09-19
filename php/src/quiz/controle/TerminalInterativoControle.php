<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\R;

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

            case "processar":
                $this->processarR();
                break;
        }
    }
    
    public function mostrarTerminal(){
        $comandos = array(
            "A = 1",
            "B = A + 2\nprint(B)"
        );

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "terminal_interativo/inicio.html",
            ["comandos" => $comandos ]);
    }

    public function processarR(){
        $comandos = $_REQUEST["comandos"];

        $r = new R();
        $resultados = $r->processar($comandos);

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "terminal_interativo/inicio.html",
            [ "resultados" => $resultados,
              "comandos" => $comandos ]);
    }
}

?>