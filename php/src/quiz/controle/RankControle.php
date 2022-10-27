<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Rank;
use QuizEstatistico\modelo\dao\RankDAO;

/**
 * Description of RankControle
 *
 * @author Wagner e Mayko
 */
class RankControle {    
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
        $c = new Rank();
        $c->setNome($_REQUEST["nome"]);
        $c->setPontuacao($_REQUEST["pontuacao"]);
        $c->setAcerto($_REQUEST["acerto"]);
        $c->setErro($_REQUEST["erro"]);
        $c->setCurso($_REQUEST["curso"]);

        $dao = new RankDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Rank();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);
        $c->setPontuacao($_REQUEST["pontuacao"]);
        $c->setAcerto($_REQUEST["acerto"]);
        $c->setErro($_REQUEST["erro"]);
        $c->setCurso($_REQUEST["curso"]);

        $dao = new RankDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new RankDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new RankDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new RankDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}
?>