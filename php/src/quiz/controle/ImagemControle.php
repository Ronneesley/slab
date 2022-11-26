<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Imagem;
use QuizEstatistico\modelo\dao\ImagemDAO;

/**
 * Description of ImagemControle
 *
 * @author Mayko
 */
class ImagemControle {    
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
        $c = new Imagem();
        $c->setImagem($_REQUEST["imagem"]);
        $c->setIdentificador($_REQUEST["identificador"]);

        $dao = new ImagemDAO();
        $dao->inserir($c);
    }
    
    public function alterar(){
        $c = new Imagem();
        $c->setId($_REQUEST["id"]);
        $c->setImagem($_REQUEST["imagem"]);
        $c->setIdentificador($_REQUEST["identificador"]);

        $dao = new ImagemDAO();
        $dao->alterar($c);
    }
    
    public function excluir(){
        $dao = new ImagemDAO();
        $dao->excluir($_REQUEST["id"]);
    }
    
    public function listar(){
        $dao = new ImagemDAO();
        $lista = $dao->listar();
        
        print("<pre>");
        print_r($lista);
        print("</pre>");
    }
    
    public function selecionar(){
        $dao = new ImagemDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        print_r($c);
    }
}
?>