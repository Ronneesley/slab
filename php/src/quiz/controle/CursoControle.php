<?php

include(dirname(__FILE__) . "/../modelo/dto/Curso.php");
include(dirname(__FILE__) . "/../modelo/dao/CursoDAO.php");

/**
 * Description of CursoControle
 *
 * @author aluno
 */
class CursoControle {    
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
        $c = new Curso();
        $c->setNome($_REQUEST["nome"]);

        $dao = new CursoDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Curso();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);

        $dao = new CursoDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new CursoDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new CursoDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new CursoDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}

$controle = new CursoControle();
$controle->processar($_REQUEST["acao"]);
?>