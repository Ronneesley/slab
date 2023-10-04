<?php
namespace QuizEstatistico\modelo\dao;

use pdo;
use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Tema;

/**
 * Classe para acesso aos dados do tema
 * Data Access Object (DAO) *
 * @author Wagner e Mayko
 */
class TemaDAO extends DAO {    
    
    public function inserir($tema){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO temas(tema) VALUES (?)");
        $stmt->bindValue(1, $tema->getTema());
        $stmt->execute();
    }
    
    public function alterar($tema){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update temas set tema = ? where id = ?");
        $stmt->bindValue(1, $tema->getTema());
        $stmt->bindValue(2, $tema->getId(), PDO::PARAM_INT);
        
        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from temas");
        $stmt->execute();
        $res = $stmt->fetchAll();
        $lista = array();
        
        foreach($res as $dados){        
            $c = new Tema();
            $c->setId($dados["id"]);
            $c->setTema($dados["tema"]);
            array_push($lista, $c);
        }
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from temas where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $dados = $stmt->fetch();
        
        $c = new Tema();
        $c->setId($dados["id"]);
        $c->setTema($dados["tema"]);

        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from temas where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>