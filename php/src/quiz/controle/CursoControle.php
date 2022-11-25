<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Curso;
use QuizEstatistico\modelo\dao\CursoDAO;

/**
 * Description of CursoControle
 *
 * @author aluno
 */
class CursoControle extends ControleBase {    
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
    
    public function salvar(){
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != ""){
            $this->alterar();            
        } else {
            $this->inserir();
        }
    }
    
    public function mostrarFormularioCadastro($curso = null, $mensagem = "" ){
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/cursos/cadastro.html", 
                [ "curso" => $curso, "mensagem" => $mensagem ]);
    }
    
    public function inserir(){
        $c = new Curso();
        $c->setNome($_REQUEST["nome"]);

        $dao = new CursoDAO();
        $dao->inserir($c);
        
        $this->mostrarFormularioCadastro($c, "Inserido com sucesso");
    }
    
    public function alterar(){
        $c = new Curso();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);

        $dao = new CursoDAO();
        $dao->alterar($c);
        
        $this->mostrarFormularioCadastro($c, "Alterado com sucesso");
    }
    
    public function excluir(){
        $dao = new CursoDAO();
        $dao->excluir($_REQUEST["id"]);
        
        $this->listar("Excluído com sucesso");
    }
    
    public function listar($mensagem = ""){
        $dao = new CursoDAO();
        $lista = $dao->listar();

        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/cursos/listagem.html", ["mensagem" => $mensagem, "lista" => $lista ]);
    }
    
    public function selecionar(){
        $dao = new CursoDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        $this->mostrarFormularioCadastro($c, "Selecionado com sucesso");
    }
}
?>