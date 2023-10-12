<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Quiz;

/**
 * Classe para acesso aos dados do nome quiz
 * Data Access Object (DAO) *
 * @author Wagner, Mayko, Ronneesley
 */
class QuizDAO extends DAO {    
    
    public function inserir($quiz){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO quizzes(nome) VALUES (?)");
        $stmt->bindValue(1, $quiz->getNome());
        $stmt->execute();
    }
    
    public function alterar($quiz){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update quizzes set nome = ? where id = ?");
        $stmt->bindValue(1, $quiz->getNome());
        $stmt->bindValue(2, $quiz->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from quizzes");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Quiz();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from quizzes where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Quiz();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from quizzes where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>