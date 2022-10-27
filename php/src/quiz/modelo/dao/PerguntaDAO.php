<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;

/**
 * Classe para acesso aos dados do Pergunta
 * Data Access Object (DAO) *
 * @author Wagner e Mayko
 */
class PerguntaDAO extends DAO {    
    
    public function inserir($pergunta){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO perguntas_quiz(questao,quiz) VALUES (??)");
        $stmt->bind_param("ii", $pergunta->getQuestao(),$pergunta->getQuiz());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($pergunta){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update pergunta_quiz set questao = ?, quiz = ? where id = ?");
        $stmt->bind_param("iii", $pergunta->getQuestao(),$pergunta->getQuiz(),$pergunta->getId(),);
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from pergunta_quiz");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Pergunta();
            $c->setId($dados["id"]);
            $c->setQuestao($dados["questao"]);
            $c->setQuiz($dados["quiz"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from perguntas_quiz where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Pergunta();
        $c->setId($dados["id"]);
        $c->setQuestao($dados["questao"]);
        $c->setQuiz($dados["quiz"]);
        
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from pergunta_quiz where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>
