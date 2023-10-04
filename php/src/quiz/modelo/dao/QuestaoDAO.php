<?php
namespace QuizEstatistico\modelo\dao;

use pdo;

use QuizEstatistico\modelo\dao\DAO;
use QuizEstatistico\modelo\dto\Questao;

/**
 * Classe para acesso aos dados da Questão
 * Data Access Object (DAO)
 * @author Mayko, Wagner, Ronneesley
 */
class QuestaoDAO extends DAO {
    
    public function sortearQuestao($ids_questoes_respondidas = array()){
        $con = $this->conectar();
        
        $filtro = "";
        
        if (!empty($ids_questoes_respondidas)){
            $ids = "";
            $i = 0;
            foreach ($ids_questoes_respondidas as $id){
                if ($i > 0){
                    $ids .= ", ";
                }

                $ids .= $id;
                $i++;
            }
            
            $filtro = " where id not in (" . $ids . ") ";
        }
        
        $sql = "select q.*, rand() as sorteio "
                . "from questoes as q " . $filtro
                . " order by sorteio limit 1";
        
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        if ($dados != false){
            $c = new Questao();
            $this->preencherQuestao($c, $dados);
        }
        
        return $c;
    }
    
    private function preencherQuestao($c, $dados){
        $c->setId($dados["id"]);
        $c->setNivel($dados["nivel"]);
        $c->setCurso($dados["curso"]);
        $c->setTema($dados["tema"]);
        $c->setPergunta($dados["pergunta"]);
        $c->setRespostaCerta($dados["resposta_certa"]);
        $c->setRespostaErrada1($dados["resposta_errada1"]); 
        $c->setRespostaErrada2($dados["resposta_errada2"]);            
        $c->setRespostaErrada3($dados["resposta_errada3"]);
        $c->setExplicacao($dados["explicacao"]);
    }
    
    public function inserir($questao){
        $con = $this->conectar();
        
        $stmt = $con->prepare("INSERT INTO questoes(nivel,curso,tema,pergunta,resposta_certa,resposta_errada1,resposta_errada2,resposta_errada3,explicacao) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bindValue(1, $questao->getNivel(), PDO::PARAM_INT);
        $stmt->bindValue(2, $questao->getCurso(), PDO::PARAM_INT);
        $stmt->bindValue(3, $questao->getTema(), PDO::PARAM_INT);
        $stmt->bindValue(4, $questao->getPergunta());
        $stmt->bindValue(5, $questao->getRespostaCerta());
        $stmt->bindValue(6, $questao->getRespostaErrada1());
        $stmt->bindValue(7, $questao->getRespostaErrada2());
        $stmt->bindValue(8, $questao->getRespostaErrada3());
        $stmt->bindValue(9, $questao->getExplicacao());
        
        $stmt->execute();
    }
    
    public function alterar($questao){
        $con = $this->conectar();
        
        $stmt = $con->prepare("update questoes set 
            nivel = ?, curso = ?, tema = ?, pergunta = ?,
            resposta_certa = ?,resposta_errada1 = ?,
            resposta_errada2 = ?,resposta_errada3 = ?,
            explicacao = ? where id = ?");
        $stmt->bindValue(1, $questao->getNivel(), PDO::PARAM_INT);
        $stmt->bindValue(2, $questao->getCurso(), PDO::PARAM_INT);
        $stmt->bindValue(3, $questao->getTema(), PDO::PARAM_INT);
        $stmt->bindValue(4, $questao->getPergunta());
        $stmt->bindValue(5, $questao->getRespostaCerta());
        $stmt->bindValue(6, $questao->getRespostaErrada1());
        $stmt->bindValue(7, $questao->getRespostaErrada2());
        $stmt->bindValue(8, $questao->getRespostaErrada3());
        $stmt->bindValue(9, $questao->getExplicacao());
        $stmt->bindValue(10, $questao->getId());
        $stmt->execute();        
    }
    
    public function listar(){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from questoes");
        $stmt->execute();
        $res = $stmt->fetchAll();
        
        $lista = array();
        
        foreach ($res as $dados){
            $c = new Questao();
            $this->preencherQuestao($c, $dados);
            
            array_push($lista, $c);
        }
        
        return $lista;
    }
    
    public function selecionar($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("select * from questoes where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch();
        
        $c = new Questao();
        $c->setId($dados["id"]);
        $c->setNivel($dados["nivel"]);
        $c->setCurso($dados["curso"]);
        $c->setTema($dados["tema"]);
        $c->setPergunta($dados["pergunta"]);
        $c->setRespostaCerta($dados["resposta_certa"]);
        $c->setRespostaErrada1($dados["resposta_errada1"]); 
        $c->setRespostaErrada2($dados["resposta_errada2"]);            
        $c->setRespostaErrada3($dados["resposta_errada3"]);
        $c->setExplicacao($dados["explicacao"]);
        
        return $c;
    }
    
    public function excluir($id){
        $con = $this->conectar();
        
        $stmt = $con->prepare("delete from questoes where id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
