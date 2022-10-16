<?php

include(dirname(__FILE__) . "/../modelo/dto/Administrador.php");
include(dirname(__FILE__) . "/../modelo/dao/AdministradorDAO.php");

/**
 * Description of CursoControle
 *
 * @author Wagner e Mayko
 */
class AdministradorControle {    
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
        $c = new Administrador();
        $c->setNome($_REQUEST["nome"]);
        $c->setEmail($_REQUEST["email"]);
        $c->setSenha($_REQUEST["senha"]);

        $dao = new AdministradorDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Administrador();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);
        $c->setEmail($_REQUEST["email"]);
        $c->setSenha($_REQUEST["senha"]);

        $dao = new AdministradorDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new AdministradorDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new AdministradorDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new AdministradorDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}

$controle = new AdministradorControle();
$controle->processar($_REQUEST["acao"]);
?>