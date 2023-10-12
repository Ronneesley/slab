<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Rank;
use QuizEstatistico\modelo\dto\Usuario;

/**
 * Classe para acesso aos dados do rank
 * Data Access Object (DAO)
 * @author Wagner, Mayko, Ronneesley
 */
class RankDAO extends DAO {    
    
    public function inserir($rank){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO 
            ranks(pontuacao, acerto, erro, usuario, quiz)
            VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $rank->getPontuacao());
        $stmt->bindValue(2, $rank->getAcerto());
        $stmt->bindValue(3, $rank->getErro());
        $stmt->bindValue(4, $rank->getUsuario()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(5, $rank->getQuiz()->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function alterar($rank){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update ranks set pontuacao = ?, acerto = ?, erro = ?, where usuario = ?");
        $stmt->bindValue(1, $rank->getPontuacao());
        $stmt->bindValue(2, $rank->getAcerto());
        $stmt->bindValue(3, $rank->getErro());
        $stmt->bindValue(4, $rank->getUsuario()->getId(), PDO::PARAM_INT);
        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare(
            "select u.id as 'id_usuario', u.nome as 'nome_usuario', sum(r.pontuacao) 
            as 'pontuacao_acumulada', sum(r.acerto) as 'acertos_acumulados', sum(r.erro) 
            as 'erros acumulados', max(c.nome) as 'curso_usuario', max(q.nome) as 'quiz' 
            from ranks as r left join usuarios as u on r.usuario = u.id 
            left join cursos as c on u.curso = c.id left join quizzes as q on r.quiz = q.id
            group by u.id order by sum(r.pontuacao) desc limit 10");

        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Rank();
            $u = new Usuario($dados["id_usuario"], $dados["nome_usuario"], $dados["curso_usuario"]);

            $u->setId($dados["id_usuario"]);
            $u->setNome($dados["nome_usuario"]);
            $u->setCurso($dados["curso_usuario"]);
            $c->setUsuario($u);
            $c->setPontuacao($dados["pontuacao_acumulada"]);
            $c->setAcerto($dados["acertos_acumulados"]);
            $c->setErro($dados["erros acumulados"]);
            $c->setQuiz($dados["quiz"]);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare(
            "select u.id as 'id_usuario', 
            u.nome as 'nome_usuario', 
            sum(r.pontuacao) as 'pontuacao', 
            sum(r.acerto) as 'acerto', 
            sum(r.erro) as 'erro',
            max(c.nome) as 'curso_usuario', 
            max(q.nome) as 'quiz' 
            from ranks as r
            inner join usuarios as u
            on r.usuario = u.id
            inner join cursos as c
            on u.curso = c.id 
            inner join quizzes as q 
            on r.quiz = q.id 
            where u.id = ? 
            group by u.id");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        if ($dados !== false) {
            $c = new Rank();
            $u = new Usuario($dados["id_usuario"], $dados["nome_usuario"], $dados["curso_usuario"]);

            $u->setId($dados["id_usuario"]);
            $u->setNome($dados["nome_usuario"]);
            $u->setCurso($dados["curso_usuario"]);
            $c->setUsuario($u);
            $c->setPontuacao($dados["pontuacao"]);
            $c->setAcerto($dados["acerto"]);
            $c->setErro($dados["erro"]);
            $c->setQuiz($dados["quiz"]);

        
            return $c;
        } else {
            return null;
        }
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from ranks where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
        public function verificarUsuario($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from ranks where usuario = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Rank();
        $c->setId($dados["id"]);
        $c->setPontuacao($dados["pontuacao"]);
        $c->setAcerto($dados["acerto"]);
        $c->setErro($dados["erro"]);
        
        return $c;
    }
}

?>