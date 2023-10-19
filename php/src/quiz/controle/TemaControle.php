<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Tema;
use QuizEstatistico\modelo\dao\TemaDAO;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Description of TemaControle
 *
 * @author Wagner e Mayko
 */
class TemaControle extends ControleBase {    
    public function processar($acao){
        if ($this->estaLogado()){
            switch ($acao){
                case "novo":
                    $this->mostrarFormularioCadastro();
                    break;
                case "salvar":
                    $this->salvar();
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
    
    public function salvar(){
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != ""){
            $this->alterar();            
        } else {
            $this->inserir();
        }
    }
    
    public function mostrarFormularioCadastro($tema = null, $mensagem = "" ){
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/temas/cadastro.html",
                [ "tema" => $tema, "mensagem" => $mensagem ]);
    }
    
    public function inserir(){
        $c = new Tema();
        $c->setNome($_REQUEST["nome"]);

        $dao = new TemaDAO();
        $dao->inserir($c);
        
        $this->mostrarFormularioCadastro($c, "Inserido com sucesso");
    }
    
    public function alterar(){
        $c = new Tema();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);

        $dao = new TemaDAO();
        $dao->alterar($c);
        
        $this->mostrarFormularioCadastro($c, "Alterado com sucesso");
    }
    
    public function excluir(){
        $dao = new TemaDAO();
        $dao->excluir($_REQUEST["id"]);
        
        $this->listar("Excluído com sucesso");
    }
    
    public function listar($mensagem = ""){
        $dao = new TemaDAO();
        $lista = $dao->listar();
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/temas/listagem.html", 
                ["mensagem" => $mensagem, "lista" => $lista ]);
    }
    
    public function selecionar(){
        $dao = new TemaDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        $this->mostrarFormularioCadastro($c, "Selecionado com sucesso");
    }
}
?>