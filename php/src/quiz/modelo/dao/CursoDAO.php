<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Curso;

use pdo;

/**
 * Classe para acesso aos dados do curso
 * Data Access Object (DAO) *
 * @author Ronneesley
 */
class CursoDAO extends DAO {
    
    public function inserir($curso){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO cursos(nome) VALUES (?)");
        $stmt->bindValue(1, $curso->getNome());
        $stmt->execute();

        $curso->setId( $con->lastInsertId() );
    }
    
    public function alterar($curso){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update cursos set nome = ? where id = ?");
        $stmt->bindValue(1, $curso->getNome());
        $stmt->bindValue(2, $curso->getId(), PDO::PARAM_INT);
        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from cursos");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Curso();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from cursos where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();

        $c = new Curso();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from cursos where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();        
    }
}

?>
