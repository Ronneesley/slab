<?php
namespace QuizEstatistico\modelo\dao;

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
                print_r($stmt);
        @$stmt->bind_param("ssssi", 
            $usuario->getNome(), 
            $usuario->getEmail(), 
            md5($usuario->getSenha()),
            $usuario->getLogin(),
            $usuario->getCurso()->getId());

        $stmt->execute();

        $usuario->setId( $con->insert_id );
        
        $con->close();
    }
    
    public function alterar($usuario){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update usuarios set 
            nome = ?, email = ?, login = ?, curso = ? where id = ?");
        @$stmt->bind_param("sssii", 
            $usuario->getNome(), 
            $usuario->getEmail(), 
            $usuario->getLogin(),
            $usuario->getCurso()->getId(),
            $usuario->getId());
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
            $c = new Usuario();
            $this->preencher($c, $dados);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
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
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Usuario();
        $this->preencher($c, $dados);
        
        $con->close();
        
        return $c;
    }

    public function logar($email, $senha){
        $con = $this->conectar();

        $stmt = $con->prepare("select * from usuarios where email = ? and senha = ?");
        @$stmt->bind_param("ss", $email, md5($senha));
        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows == 1){
            
            $dados = $res->fetch_assoc();
            
            $c = new Usuario();
            $this->preencher($c, $dados);
            
            $con->close();
            
            return $c;
        } else {
            $con->close();

            return null;
        }
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