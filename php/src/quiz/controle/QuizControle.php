<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Quiz;
use QuizEstatistico\modelo\dao\QuizDAO;
use QuizEstatistico\controle\ControleBase;
use QuizEstatistico\modelo\dao\QuestaoDAO;

/**
 * Description of QuizControle
 *
 * @author Wagner e Mayko
 */
class QuizControle extends ControleBase {
    public function processar($acao){
        switch ($acao){
            case "comecar":
                $this->comecar();
                break;
            case "responder":
                $this->responder();
                break;
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
    
    public function comecar(){
        session_start();
        
        $dao = new QuestaoDAO();
        $q = $dao->sortearQuestao();
        
        $opcoes = array($q->getResposta_certa(), $q->getResposta_errada1(),
            $q->getResposta_errada2(), $q->getResposta_errada3());
        $indices = [0, 1, 2, 3];
        shuffle($indices);
        $letrasOpcoes = array(
            $indices[0] => $opcoes[0],
            $indices[1] => $opcoes[1],
            $indices[2] => $opcoes[2],
            $indices[3] => $opcoes[3],
        );
        
        $pontuacao = 0;
        $_SESSION["indice_resposta_correta"] = $indices[0];
        $_SESSION["pontuacao"] = $pontuacao;        
       
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "perguntas.html", 
                ["questao" => $q, 
                 "letrasOpcoes" => $letrasOpcoes,
                 "pontuacao" => $pontuacao ]);
    }
    
    public function responder(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "perguntas.html");
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
?>