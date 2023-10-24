<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Quiz;
use QuizEstatistico\modelo\dao\QuizDAO;
use QuizEstatistico\controle\ControleBase;
use QuizEstatistico\modelo\dao\QuestaoDAO;
use QuizEstatistico\modelo\dao\UsuarioDAO;
use QuizEstatistico\modelo\dao\RankDAO;
use QuizEstatistico\modelo\dto\Rank;
use QuizEstatistico\modelo\dto\Usuario;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Description of QuizControle
 *
 * @author Wagner e Mayko
 */
class QuizControle extends ControleBase {
    public function processar($acao){
        if ($this->estaLogado()){
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
                case "salvar":
                    $this->salvar();
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
                case "salvarRank":
                    $this->salvarRank();
                    break;
                case "quiz":
                    $this->mostrarPaginaInicialQuiz();
                    break;
                }
            }else{
                $p = new PrincipalControle();
                $p->mostrarPaginaLogin("Faça login primeiro!");
            }
    }
    
    public function comecar(){
        @session_start();
        
        $_SESSION["pontuacao"] = 0;
        $_SESSION["questoes_respondidas"] = array();
        $_SESSION["ultima_questao"] = "";
        $_SESSION["quiz_id"] = $_REQUEST["quizzes"];
        $this->mostrarProximaQuestao();        
    }
    
    public function responder(){
        @session_start();
        
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
        
        $coloracoes = array("#EB6534", "#EB6534", "#EB6534", "#EB6534");
        $coloracoes[$_SESSION["indice_resposta_correta"]] = "#24bf1f";
        
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

            $opcoes = array($q->getRespostaCerta(), $q->getRespostaErrada1(),
                $q->getRespostaErrada2(), $q->getRespostaErrada3());
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
                
        $this->salvarRank();
        $_SESSION["pontuacao"] = 0;
        $_SESSION["questoes_respondidas"] = array();

    }
    public function salvar(){
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != ""){
            $this->alterar();            
        } else {
            $this->inserir();
        }
    }

    public function mostrarFormularioCadastro($quiz = null, $mensagem = "",$tipo_mensagem = "success",$parametros = array()){
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/quiz/cadastro.html",
        [ "quiz" => $quiz, 
        "mensagem" => $mensagem,
        "tipo_mensagem" => $tipo_mensagem ]);
    }
    
    
    public function inserir(){
        $c = new Quiz();
        $c->setNome($_REQUEST["nome"]);

        $dao = new QuizDAO();
        $dao->inserir($c);

        $this->mostrarFormularioCadastro($c, "Inserido com sucesso");
    }
    
    public function alterar(){
        $c = new Quiz();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);

        $dao = new QuizDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new QuizDAO();
        $dao->excluir($_REQUEST["id"]);

        $this->listar("Excluído com sucesso");
    }
    
    public function listar($mensagem = "", $tipo_mensagem = "success"){
        $dao = new QuizDAO();
        $lista = $dao->listar();
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, 
            "admin/quiz/listagem.html", 
            ["mensagem" => $mensagem, 
            "lista" => $lista,
            "tipo_mensagem" => $tipo_mensagem]);
    }
    
    public function selecionar(){
        $dao = new QuizDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        $this->mostrarFormularioCadastro($c, "Selecionado com sucesso");
    }
    public function salvarRank(){
        $rank = new Rank();
        $quizDAO = new QuizDAO();
        $rank->setPontuacao($_SESSION["pontuacao"]);
        $rank->setAcerto($_SESSION["pontuacao"]);
        $rank->setErro(count($_SESSION["questoes_respondidas"])-$_SESSION["pontuacao"]);
        $rank->setUsuario($_SESSION["usuario"]);
        $rank->setQuiz($quizDAO->selecionar($_SESSION["quiz_id"]));
        $RankDAO = new RankDAO();

        $RankDAO->inserir($rank);
        
    }

    public function mostrarPaginaInicialQuiz() {
        $dao = new QuizDAO();
        $quizzes = $dao->listar();

        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "inicio_quiz.html",
            ["quizzes" => $quizzes]);
    }
}
?>