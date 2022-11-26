<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Pergunta;
use QuizEstatistico\modelo\dao\PerguntaDAO;

/**
 * Description of PerguntaControle
 *
 * @author Diosef e Wagner
 */
class PerguntaControle {    
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
        $c = new Pergunta();
        $c->setQuestao($_REQUEST["questao"]);
        $c->setQuiz($_REQUEST["quiz"]);

        $dao = new PerguntaDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Pergunta();
        $c->setId($_REQUEST["id"]);
        $c->setQuestao($_REQUEST["questao"]);
        $c->setQuiz($_REQUEST["quiz"]);
        $dao = new PerguntaDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new PerguntaDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new PerguntaDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new PerguntaDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}
?>