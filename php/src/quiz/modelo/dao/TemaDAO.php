<?php
namespace QuizEstatistico\modelo\dao;

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
        $stmt->bind_param("s", $tema->getTema());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($tema){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update temas set tema = ? where id = ?");
        $stmt->bind_param("si", $tema->getTema(), $tema->getId());
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from temas");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Tema();
            $c->setId($dados["id"]);
            $c->setTema($dados["tema"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from temas where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Tema();
        $c->setId($dados["id"]);
        $c->setTema($dados["tema"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from temas where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $con->close();
    }
}

?>