<?php

include(dirname(__FILE__) . "/../modelo/dto/Tema.php");
include(dirname(__FILE__) . "/../modelo/dao/TemaDAO.php");

/**
 * Description of TemaControle
 *
 * @author Wagner e Mayko
 */
class TemaControle {    
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
        $c = new Tema();
        $c->setTema($_REQUEST["tema"]);

        $dao = new TemaDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Tema();
        $c->setId($_REQUEST["id"]);
        $c->setTema($_REQUEST["tema"]);

        $dao = new TemaDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new TemaDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new TemaDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new TemaDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}

$controle = new TemaControle();
$controle->processar($_REQUEST["acao"]);
?>