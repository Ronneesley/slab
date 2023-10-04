<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Nivel;

/**
 * Classe para acesso aos dados do nivel
 * Data Access Object (DAO) *
 * @author Mayko, Wagner, Ronneesley
 */
class NivelDAO extends DAO {    
    
    public function inserir($nivel){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO niveis(nome) VALUES (?)");
        $stmt->bindValue(1, $nivel->getNome());
        $stmt->execute();
    }
    
    public function alterar($nivel){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update niveis set nome = ? where id = ?");
        $stmt->bindValue(1, $nivel->getNome());
        $stmt->bindValue(2, $nivel->getId(), PDO::PARAM_INT);
        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from niveis");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Nivel();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);

            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from niveis where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Nivel();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);        
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from niveis where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
