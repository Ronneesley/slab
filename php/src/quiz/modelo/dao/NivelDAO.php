<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Nivel;

/**
 * Classe para acesso aos dados do nivel
 * Data Access Object (DAO) *
 * @author Mayko e Wagner
 */
class NivelDAO extends DAO {    
    
    public function inserir($nivel){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO niveis(nivel) VALUES (?)");
        $stmt->bind_param("s", $nivel->getNivel());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($nivel){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update niveis set nivel = ? where id = ?");
        $stmt->bind_param("si", $nivel->getNivel(), $nivel->getId());
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from niveis");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Nivel();
            $c->setId($dados["id"]);
            $c->setNivel($dados["nivel"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from niveis where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Nivel();
        $c->setId($dados["id"]);
        $c->setNivel($dados["nivel"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from niveis where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>
