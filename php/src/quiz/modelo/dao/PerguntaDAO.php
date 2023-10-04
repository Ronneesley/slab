<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Pergunta;

/**
 * Classe para acesso aos dados do Pergunta
 * Data Access Object (DAO) 
 * @author Wagner, Mayko, Ronneesley
 */
class PerguntaDAO extends DAO {    
    
    public function inserir($pergunta){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO perguntas_quiz(questao,quiz) VALUES (??)");
        $stmt->bindValue(1, $pergunta->getQuestao(), PDO::PARAM_INT);
        $stmt->bindValue(2, $pergunta->getQuiz(), PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function alterar($pergunta){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update pergunta_quiz set questao = ?, quiz = ? where id = ?");
        $stmt->bindValue(1, $pergunta->getQuestao(), PDO::PARAM_INT);
        $stmt->bindValue(2, $pergunta->getQuiz(), PDO::PARAM_INT);
        $stmt->bindValue(3, $pergunta->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from pergunta_quiz");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Pergunta();
            $c->setId($dados["id"]);
            $c->setQuestao($dados["questao"]);
            $c->setQuiz($dados["quiz"]);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from perguntas_quiz where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Pergunta();
        $c->setId($dados["id"]);
        $c->setQuestao($dados["questao"]);
        $c->setQuiz($dados["quiz"]);        
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from pergunta_quiz where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
