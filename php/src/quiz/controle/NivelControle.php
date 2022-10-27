<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Nivel;
use QuizEstatistico\modelo\dao\NivelDAO;

/**
 * Description of NivelControle
 *
 * @author Wagner e Mayko
 */
class NivelControle {    
    public function processar($acao){
        switch ($acao){
            case "inserir":
                $this->inserir();
                break;
            case "alterar":
                $this->alterar();
                break;
            case "listar":
                $this->listar();
                break;
            case "excluir":
                $this->excluir();
                break;
            case "selecionar":
                $this->selecionar();
                break;
        }
    }
    
    public function inserir(){
        $c = new Nivel();
        $c->setNivel($_REQUEST["nivel"]);

        $dao = new NivelDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Nivel();
        $c->setId($_REQUEST["id"]);
        $c->setNivel($_REQUEST["nivel"]);

        $dao = new NivelDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new NivelDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new NivelDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new NivelDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}
?>