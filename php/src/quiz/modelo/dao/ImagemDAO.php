<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Imagem;

/**
 * Classe para acesso aos dados da imagem
 * Data Access Object (DAO) *
 * @author Mayko, Ronneesley
 */
class ImagemDAO extends DAO {    
    
    public function inserir($imagem){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO imagens(imagem, identificador) VALUES (?, ?)");
        $stmt->bindValue(1, $imagem->getImagem());
        $stmt->bindValue(2, $imagem->getIdentificador());
        $stmt->execute();
    }
    
    public function alterar($imagem){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update imagens set imagem = ?, identificador = ? where id = ?");
        $stmt->bindValue(1, $imagem->getImagem());
        $stmt->bindValue(2, $imagem->getIdentificador());
        $stmt->bindValue(3, $imagem->getId(), PDO::PARAM_INT);
        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from imagens");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Imagem();
            $c->setId($dados["id"]);
            $c->setImagem($dados["imagem"]);
            $c->setIdentificador($dados["identificador"]);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from imagens where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Imagem();
        $c->setId($dados["id"]);
        $c->setImagem($dados["imagem"]);
        $c->setIdentificador($dados["identificador"]);
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from imagens where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();        
        
        $con->close();
    }
}

?>