<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;

/**
 * Classe para acesso aos dados do administador
 * Data Access Object (DAO) *
 * @author Wagner e Mayko 
 */
class AdministradorDAO extends DAO {    
    
    public function inserir($administrador){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO administradores(nome, email, senha) VALUES (?,?,?)");
        $stmt->bind_param("sss", $administrador->getNome(), $administrador->getEmail(), $administrador->getSenha());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($administrador){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update administradores set nome = ?, email = ?, senha = ? where id = ?");
        $stmt->bind_param("sssi", $administrador->getNome(), $administrador->getEmail(), $administrador->getSenha(),$administrador->getId());
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from administradores");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Administrador();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);
            $c->setEmail($dados["email"]);
            $c->setSenha($dados["senha"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from administradores where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Administrador();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        $c->setEmail($dados["email"]);
        $c->setSenha($dados["senha"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from administradores where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>
