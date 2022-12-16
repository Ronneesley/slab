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
            case "novo":
                $this->mostrarFormularioCadastro();
                break;
            case "comecar":
                $this->comecar();
                break;
            case "responder":
                $this->responder();
                break;
            case "proximo":
                $this->mostrarProximaQuestao();
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
        
        $_SESSION["pontuacao"] = 0;
        $_SESSION["questoes_respondidas"] = array();
        $_SESSION["ultima_questao"] = "";
        $this->mostrarProximaQuestao();        
    }
    
    public function responder(){
        session_start();
        
        $resposta = $_REQUEST["resposta"];

        $acertou = $_SESSION["indice_resposta_correta"] == $resposta;
        
        $letrasOpcoes = array(
            0 => $_SESSION["opcao_a"],
            1 => $_SESSION["opcao_b"],
            2 => $_SESSION["opcao_c"],
            3 => $_SESSION["opcao_d"]
        );
        
        $q = $_SESSION["questao"];
        $ultima_questao = $_SESSION["ultima_questao"];
        $pontuacao = $_SESSION["pontuacao"];        
        
        $coloracoes = array("white", "white", "white", "white");
        $coloracoes[$_SESSION["indice_resposta_correta"]] = "green";
        
        if ($acertou){
            if($ultima_questao != $q){
                $pontuacao++;
            }
        } else {
            $coloracoes[$resposta] = "red";
        }
        
        $_SESSION["pontuacao"] = $pontuacao;
        $_SESSION["ultima_questao"] = $q;
        
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "perguntas.html",
                ["questao" => $q, 
                 "letrasOpcoes" => $letrasOpcoes,
                 "pontuacao" => $pontuacao,
                 "acertou" => $acertou,
                 "coloracoes" => $coloracoes ] );
    }
    
    public function mostrarProximaQuestao(){
        if (!$this->eMomentoPararQuiz()){
            @session_start();

            $ids_questoes_respondidas = $_SESSION["questoes_respondidas"];

            $dao = new QuestaoDAO();
            $q = $dao->sortearQuestao($ids_questoes_respondidas);

            array_push($_SESSION["questoes_respondidas"], $q->getId());

            $opcoes = array($q->getResposta_certa(), $q->getResposta_errada1(),
                $q->getResposta_errada2(), $q->getResposta_errada3());
            $indices = [0, 1, 2, 3];
            shuffle($indices); //ex.: [2, 1, 0, 3]
            $letrasOpcoes = array(
                $indices[0] => $opcoes[0],
                $indices[1] => $opcoes[1],
                $indices[2] => $opcoes[2],
                $indices[3] => $opcoes[3],
            );

            $_SESSION["indice_resposta_correta"] = $indices[0];
            $pontuacao = $_SESSION["pontuacao"];

            $_SESSION["opcao_a"] = $letrasOpcoes[0];
            $_SESSION["opcao_b"] = $letrasOpcoes[1];
            $_SESSION["opcao_c"] = $letrasOpcoes[2];
            $_SESSION["opcao_d"] = $letrasOpcoes[3];
            $_SESSION["questao"] = $q;

            $layout = $this->configurarTemplate("layout.html");
            $this->mostrarPaginaLayout($layout, "perguntas.html", 
                    ["questao" => $q, 
                     "letrasOpcoes" => $letrasOpcoes,
                     "pontuacao" => $pontuacao,
                     "acertou" => null]);
        } else {
            $this->mostrarFimQuiz();
        }
    }
    
    public function eMomentoPararQuiz(){
        @session_start();
        
        $ids_questoes_respondidas = $_SESSION["questoes_respondidas"];
        
        if (count($ids_questoes_respondidas) >= 5){
            return true;
        }
        
        return false;
    }
    
    public function mostrarFimQuiz(){
        $pontuacao = $_SESSION["pontuacao"];
        
        $ids_questoes_respondidas = $_SESSION["questoes_respondidas"];
        
        $qtde_questoes_respondidas = count($ids_questoes_respondidas);
        
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "fim_quiz.html", 
                ["pontuacao" => $pontuacao,
                 "qtde_questoes_respondidas" => $qtde_questoes_respondidas]);
    }
    
    public function mostrarFormularioCadastro($questao = null, $mensagem = "",$parametros = array()){        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/quiz/cadastro.html");
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