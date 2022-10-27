<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;

/**
 * Classe para acesso aos dados do nome quiz
 * Data Access Object (DAO) *
 * @author Wagner e Mayko
 */
class QuizDAO extends DAO {    
    
    public function inserir($quiz){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO quizzes(nome_quiz) VALUES (?)");
        $stmt->bind_param("s", $quiz->getNome_quiz());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($quiz){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update quizzes set nome_quiz = ? where id = ?");
        $stmt->bind_param("si", $quiz->getNome_quiz(), $quiz->getId());
        $stmt->execute();
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from cursos");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Quiz();
            $c->setId($dados["id"]);
            $c->setNome_quiz($dados["nome_quiz"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from quizzes where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Quiz();
        $c->setId($dados["id"]);
        $c->setNome_quiz($dados["nome_quiz"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from quizzes where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>