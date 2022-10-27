<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;

/**
 * Classe para acesso aos dados do rank
 * Data Access Object (DAO) *
 * @author Wagner e Mayko
 */
class RankDAO extends DAO {    
    
    public function inserir($rank){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO ranks(nome, pontuacao, acerto, erro, curso) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $rank->getNome(), $rank->getPontuacao(), $rank->getAcerto(), $rank->getErro(), $rank->getCurso());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($rank){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update ranks set nome = ?, pontuacao = ?, acerto = ?, erro = ?, curso = ? where id = ?");
        $stmt->bind_param("ssssii", $rank->getNome(), $rank->getPontuacao(), $rank->getAcerto(), $rank->getErro(), $rank->getCurso(), $rank->getId());
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from ranks");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Rank();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);
            $c->setPontuacao($dados["pontuacao"]);
            $c->setAcerto($dados["acerto"]);
            $c->setErro($dados["erro"]);
            $c->setCurso($dados["curso"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from ranks where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Rank();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        $c->setPontuacao($dados["pontuacao"]);
        $c->setAcerto($dados["acerto"]);
        $c->setErro($dados["erro"]);
        $c->setCurso($dados["curso"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from ranks where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>