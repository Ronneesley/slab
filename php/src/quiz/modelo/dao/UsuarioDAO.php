<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dao\CursoDAO;
use QuizEstatistico\modelo\dto\Usuario;

/**
 * Classe para acesso aos dados do curso
 * Data Access Object (DAO)
 * @author Ronneesley Moura Teles
 */
class UsuarioDAO extends DAO {    
    
    public function inserir($usuario){
        $con = $this->conectar();
        
        $stmt = $con->prepare("insert into usuarios(nome, email, senha, login, curso) 
                values(?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $usuario->getNome());
        $stmt->bindValue(2, $usuario->getEmail());
        $stmt->bindValue(3, md5($usuario->getSenha()));
        $stmt->bindValue(4, $usuario->getLogin());
        $stmt->bindValue(5, $usuario->getCurso()->getId(), PDO::PARAM_INT);

        $stmt->execute();

        $usuario->setId( $con->lastInsertId() );
    }
    
    public function alterar($usuario){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update usuarios set 
            nome = ?, email = ?, login = ?, curso = ? where id = ?");
        $stmt->bindValue(1, $usuario->getNome());
        $stmt->bindValue(2, $usuario->getEmail());
        $stmt->bindValue(3, $usuario->getLogin());
        $stmt->bindValue(4, $usuario->getCurso()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(5, $usuario->getId(), PDO::PARAM_INT);

        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from usuarios");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Usuario();
            $this->preencher($c, $dados);
            
            array_push($lista, $c);
        }        
        
        return $lista;
    }

    public function preencher($c, $dados){
        $cursoDAO = new CursoDAO();

        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        $c->setEmail($dados["email"]);
        $c->setLogin($dados["login"]);

        $c->setCurso($cursoDAO->selecionar($dados["curso"]));
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from usuarios where id = ?");
        $stmt->bindVAlue(1, $id);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Usuario();
        $this->preencher($c, $dados);
        
        return $c;
    }

    public function logar($email, $senha){
        $con = $this->conectar();

        $stmt = $con->prepare("select * from usuarios where email = ? and senha = ?");
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, md5($senha));
        $stmt->execute();

        $dados = $stmt->fetch();

        if ($dados != false){
            $c = new Usuario();
            $this->preencher($c, $dados);

            return $c;
        } else {
            return null;
        }
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from usuarios where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>