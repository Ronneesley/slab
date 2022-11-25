<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Nivel;
use QuizEstatistico\modelo\dao\NivelDAO;

/**
 * Description of NivelControle
 *
 * @author Wagner e Mayko
 */
class NivelControle extends ControleBase {    
    public function processar($acao){
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
    }
    
    public function salvar() {
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "") {
            $this->alterar();
        } else {
            $this->inserir();
        }
    }
    
    public function mostrarFormularioCadastro($nivel = null, $mensagem = "" ){
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/niveis/cadastro.html", [ "nivel" => $nivel, "mensagem" => $mensagem]);
    }

        public function inserir(){
        $c = new Nivel();
        $c->setNivel($_REQUEST["nivel"]);

        $dao = new NivelDAO();
        $dao->inserir($c);
        
        $this->mostrarFormularioCadastro($c, "Inserido com sucesso");
    }
    
    public function alterar(){
        $c = new Nivel();
        $c->setId($_REQUEST["id"]);
        $c->setNivel($_REQUEST["nivel"]);

        $dao = new NivelDAO();
        $dao->alterar($c);
        
        $this->mostrarFormularioCadastro($c, "Alterado com sucesso");
    }
    
    public function excluir(){
        $dao = new NivelDAO();
        $dao->excluir($_REQUEST["id"]);
        
        $this->listar("Excluído com sucesso");
    }
    
    public function listar($mensagem = ""){
        $dao = new NivelDAO();
        $lista = $dao->listar();
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/niveis/listagem.html", ["mensagem" => $mensagem, "lista" => $lista]);
    }
    
    public function selecionar(){
        $dao = new NivelDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        $this->mostrarFormularioCadastro($c, "Selecionado com sucesso");
    }
}
?>