<?php
namespace QuizEstatistico\modelo\dao;

use QuizEstatistico\modelo\dao\DAO;

/**
 * Classe para acesso aos dados da Questão
 * Data Access Object (DAO) *
 * @author Mayko e Wagner
 */
class QuestaoDAO extends DAO {    
    
    public function inserir($questao){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO questoes(nivel,curso, tema,pergunta,respota_certa,resposta_errada1,resposta_errada2,resposta_errada3,explicacao) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iiissssss", $questao->getNivel(),$questao->getCurso(), $questao->getTema(), $questao->getPergunta(), $questao->getResposta_certa(),$questao->getResposta_errrada1(),$questao->getResposta_errrada2(),$questao->getResposta_errrada3(),$questao->getEplicacao());
        $stmt->execute();
        
        $con->close();
    }
    
    public function alterar($questao){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update questao set nivel = ?,curso = ?, tema = ?,pergunta = ?,respota_certa = ?,resposta_errada1 = ?,resposta_errada2 = ?,resposta_errada3 = ?,explicacao = ? where id = ?");
        $stmt->bind_param("iiissssssi", $questao->getNivel(),$questao->getCurso(), $questao->getTema(), $questao->getPergunta(), $questao->getResposta_certa(),$questao->getResposta_errrada1(),$questao->getResposta_errrada2(),$questao->getResposta_errrada3(),$questao->getEplicacao(),$questao->getId());
        $stmt->execute();        
        
        $con->close();
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from questoes");
        $stmt->execute();
        $res = $stmt->get_result();
        
        $lista = array();
        
        while ($dados = $res->fetch_assoc()){        
            $c = new Questao();
            $c->setId($dados["id"]);
            $c->setNivel($dados["nivel"]);
            $c->setCurso($dados["curso"]);
            $c->setTema($dados["tema"]);
            $c->setPergunta($dados["pergunta"]);
            $c->setResposta_certa($dados["resposta_certa"]);
            $c->setResposta_errada1($dados["resposta_errada1"]); 
            $c->setResposta_errada2($dados["resposta_errada2"]);            
            $c->setResposta_errada3($dados["resposta_errada3"]);
            $c->setExplicacao($dados["explicacao"]);

            
            array_push($lista, $c);
        }
        
        $con->close();
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from questoes where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $dados = $res->fetch_assoc();
        
        $c = new Questao();
        $c->setId($dados["id"]);
        $c->setNivel($dados["nivel"]);
        $c->setCurso($dados["curso"]);
        $c->setTema($dados["tema"]);
        $c->setPergunta($dados["pergunta"]);
        $c->setResposta_certa($dados["resposta_certa"]);
        $c->setResposta_errada1($dados["resposta_errada1"]); 
        $c->setResposta_errada2($dados["resposta_errada2"]);            
        $c->setResposta_errada3($dados["resposta_errada3"]);
        $c->setExplicacao($dados["explicacao"]);
        
        $con->close();
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from questoes where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        
        $con->close();
    }
}

?>
