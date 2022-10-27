<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;

/**
 * Classe para acesso aos dados da imagem
 * Data Access Object (DAO) *
 * @author Mayko
 */
class ImagemDAO extends DAO {    
    
    public function inserir($imagem){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO imagens(imagem, identificador) VALUES (?, ?)");
        $stmt->bind_param("ss", $imagem->getImagem(), $imagem->getIdentificador());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($imagem){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update imagens set imagem = ?, identificador = ? where id = ?");
        $stmt->bind_param("ssi", $imagem->getImagem(), $imagem->getIdentificador(), $imagem->getId());
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from imagens");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Imagem();
            $c->setId($dados["id"]);
            $c->setImagem($dados["imagem"]);
            $c->setIdentificador($dados["identificador"]);
            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from imagens where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Imagem();
        $c->setId($dados["id"]);
        $c->setImagem($dados["imagem"]);
        $c->setIdentificador($dados["identificador"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from imagens where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>