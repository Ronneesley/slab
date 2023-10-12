<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Administrador;

/**
 * Classe para acesso aos dados do administador
 * Data Access Object (DAO)
 * @author Wagner, Mayko, Ronneesley
 */
class AdministradorDAO extends DAO {    
    
    public function inserir($administrador){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO administradores(nome, email, senha) VALUES (?,?,?)");
        $stmt->bindValue(1, $administrador->getNome());
        $stmt->bindValue(2, $administrador->getEmail());
        $stmt->bindValue(3, $administrador->getSenha());

        $stmt->execute();

        $administrador->setId( $con->lastInsertId() );
    }
    
    public function alterar($administrador){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update administradores set nome = ?, email = ?, senha = ? where id = ?");
        $stmt->bindValue(1, $administrador->getNome());
        $stmt->bindValue(2, $administrador->getEmail());
        $stmt->bindValue(3, $administrador->getSenha());
        $stmt->bindValue(4, $administrador->getId(), PDO::PARAM_INT);

        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from administradores");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Administrador();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);
            $c->setEmail($dados["email"]);
            $c->setSenha($dados["senha"]);
            $c->setLogin($dados["login"]);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from administradores where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Administrador();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        $c->setEmail($dados["email"]);
        $c->setSenha($dados["senha"]);
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from administradores where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();        
    }
}

?>
