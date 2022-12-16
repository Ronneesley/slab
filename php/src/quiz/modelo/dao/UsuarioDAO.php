<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Usuario;

/**
 * Classe para acesso aos dados do curso
 * Data Access Object (DAO)
 * @author Ronneesley Moura Teles
 */
class UsuarioDAO extends DAO {    
    
    public function inserir($usuario){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO usuarios(nome) VALUES (?)");
        $stmt->bind_param("s", $usuario->getNome());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($usuario){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update usuarios set nome = ? where id = ?");
        $stmt->bind_param("si", $usuario->getNome(), $usuario->getId());
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from usuarios");
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
        
        $stmt = $con->prepare("select * from usuarios where id = ?");
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
        
        $stmt = $con->prepare("delete from usuarios where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>
