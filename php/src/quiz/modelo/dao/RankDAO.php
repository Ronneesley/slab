<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Rank;

/**
 * Classe para acesso aos dados do rank
 * Data Access Object (DAO)
 * @author Wagner, Mayko, Ronneesley
 */
class RankDAO extends DAO {    
    
    public function inserir($rank){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO 
            ranks(nome, pontuacao, acerto, erro, curso) 
            VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $rank->getNome());
        $stmt->bindValue(2, $rank->getPontuacao());
        $stmt->bindValue(3, $rank->getAcerto());
        $stmt->bindValue(4, $rank->getErro());
        $stmt->bindValue(5, $rank->getCurso()->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function alterar($rank){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update ranks set nome = ?, pontuacao = ?, acerto = ?, erro = ?, curso = ? where id = ?");
        $stmt->bindValue(1, $rank->getNome());
        $stmt->bindValue(2, $rank->getPontuacao());
        $stmt->bindValue(3, $rank->getAcerto());
        $stmt->bindValue(4, $rank->getErro());
        $stmt->bindValue(5, $rank->getCurso()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(5, $rank->getId(), PDO::PARAM_INT);
        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from ranks");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Rank();
            $c->setId($dados["id"]);
            $c->setNome($dados["nome"]);
            $c->setPontuacao($dados["pontuacao"]);
            $c->setAcerto($dados["acerto"]);
            $c->setErro($dados["erro"]);
            $c->setCurso($dados["curso"]);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from ranks where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Rank();
        $c->setId($dados["id"]);
        $c->setNome($dados["nome"]);
        $c->setPontuacao($dados["pontuacao"]);
        $c->setAcerto($dados["acerto"]);
        $c->setErro($dados["erro"]);
        $c->setCurso($dados["curso"]);
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from ranks where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>