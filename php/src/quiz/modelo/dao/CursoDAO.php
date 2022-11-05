<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Curso;

/**
 * Classe para acesso aos dados do curso
 * Data Access Object (DAO) *
 * @author aluno
 */
class CursoDAO extends DAO {    
    
    public function inserir($curso){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO cursos(nome) VALUES (?)");
        $stmt->bind_param("s", $curso->getNome());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($curso){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update cursos set nome = ? where id = ?");
        $stmt->bind_param("si", $curso->getNome(), $curso->getId());
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
            $c = new Curso();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from cursos where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Curso();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from cursos where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>
