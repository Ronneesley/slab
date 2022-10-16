<?php

include(dirname(__FILE__) . "/../modelo/dto/Quiz.php");
include(dirname(__FILE__) . "/../modelo/dao/QuizDAO.php");

/**
 * Description of CursoControle
 *
 * @author Wagner e Mayko
 */
class QuizControle {
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
        $c = new Quiz();
        $c->setNome_quiz($_REQUEST["nome_quiz"]);

        $dao = new QuizDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Quiz();
        $c->setId($_REQUEST["id"]);
        $c->setNome_quiz($_REQUEST["nome_quiz"]);

        $dao = new QuizDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new QuizDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new QuizDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new QuizDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}

$controle = new QuizControle();
$controle->processar($_REQUEST["acao"]);
?>