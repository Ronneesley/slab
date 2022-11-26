<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Questao;
use QuizEstatistico\modelo\dao\QuestaoDAO;

/**
 * Description of QuestãoControle
 *
 * @author Wagner e Mayko
 */
class QuestaoControle {    
    public function processar($acao){
        switch ($acao){
            case "inserir":
                $this->inserir();
                break;
            case "alterar":
                $this->alterar();
                break;
            case "listar":
                $this->listar();
                break;
            case "excluir":
                $this->excluir();
                break;
            case "selecionar":
                $this->selecionar();
                break;
        }
    }
    
    public function inserir(){
        $c = new Questao();
        $c->setNivel($_REQUEST["nivel"]);
        $c->setCurso($_REQUEST["curso"]);
        $c->setTema($_REQUEST["tema"]);
        $c->setResposta_certa($_REQUEST["resposta_certa"]);
        $c->setResposta_errada1($_REQUEST["resposta_errada1"]);
        $c->setResposta_errada2($_REQUEST["resposta_errada2"]);
        $c->setResposta_errada3($_REQUEST["resposta_errada3"]);
        $c->setExplicacao($_REQUEST["explicacao"]);


        $dao = new QuestaoDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Questao();
        $c->setId($_REQUEST["id"]);
        $c->setNivel($_REQUEST["nivel"]);
        $c->setCurso($_REQUEST["curso"]);
        $c->setTema($_REQUEST["tema"]);
        $c->setResposta_certa($_REQUEST["resposta_certa"]);
        $c->setResposta_errada1($_REQUEST["resposta_errada1"]);
        $c->setResposta_errada2($_REQUEST["resposta_errada2"]);
        $c->setResposta_errada3($_REQUEST["resposta_errada3"]);
        $c->setExplicacao($_REQUEST["explicacao"]);

        $dao = new QuestaoDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new QuestaoDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new QuestaoDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new QuestaoDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}
?>