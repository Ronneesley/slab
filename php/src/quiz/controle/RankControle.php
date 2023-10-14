<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Rank;
use QuizEstatistico\modelo\dao\RankDAO;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Description of RankControle
 *
 * @author Wagner e Mayko
 */
class RankControle extends ControleBase{    
    public function processar($acao){
        if ($this->estaLogado()){
            switch ($acao){
                case "buscar":
                    $this->mostrarBusca();
                    break;
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
        }else{
            $p = new PrincipalControle();
            $p->mostrarPaginaLogin("Faça login primeiro!");
        }
    }

    public function mostrarBusca( $rank = new Rank(),
        $mensagem = "", $tipo_mensagem = ""){
            $rankDAO = new RankDAO();
            $ranks = $rankDAO->listar();

            $layout = $this->configurarTemplate("layout.html");
            $this->mostrarPaginaLayout($layout, "ranking_acertos.html",["rank" => $rank, "mensagem" => $mensagem, 
            "tipo_mensagem" => $tipo_mensagem,
            "ranks" => $ranks]);
    }

    public function inserir(){
        $c = new Rank();
        $c->setNome($_REQUEST["nome"]);
        $c->setPontuacao($_REQUEST["pontuacao"]);
        $c->setAcerto($_REQUEST["acerto"]);
        $c->setErro($_REQUEST["erro"]);
        $c->setCurso($_REQUEST["curso"]);

        $dao = new RankDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Rank();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);
        $c->setPontuacao($_REQUEST["pontuacao"]);
        $c->setAcerto($_REQUEST["acerto"]);
        $c->setErro($_REQUEST["erro"]);
        $c->setCurso($_REQUEST["curso"]);

        $dao = new RankDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new RankDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new RankDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function encontrarPosicao($lista, $login) {
        foreach ($lista as $posicao => $rank) {
            if ($rank->getUsuario()->getLogin() === $login) {
                return $posicao + 1;
            }
    }
        return null;
    }

    public function selecionar(){
        $dao = new RankDAO();
        $lista = $dao->listar();

        $login = $_REQUEST["login"];
        $posicao = $this->encontrarPosicao($lista, $login);

        if ($posicao !== null) {
            $this->mostrarBusca($posicao, "Usuário encontrado no rank na posição $posicao.", "success");
        } else {
            $this->mostrarBusca(null, "Usuário não encontrado no rank ou não existe.", "error");
        }
    }
}
?>