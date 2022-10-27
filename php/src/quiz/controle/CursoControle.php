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
    
    public function mostrarFormularioCadastro(){
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/cursos/cadastro.html");
    }
    
    public function inserir(){
        $c = new Curso();
        $c->setNome($_REQUEST["nome"]);

        $dao = new CursoDAO();
        $dao->inserir($c);
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/cursos/cadastro.html",
                [ "mensagem" => "Inserido com sucesso" ]);
    }
    
    public function alterar(){
        $c = new Curso();
        $c->setId($_REQUEST["id"]);
        $c->setNome($_REQUEST["nome"]);

        $dao = new CursoDAO();
        $dao->alterar($c);
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/cursos/cadastro.html",
                [ "mensagem" => "Alterado com sucesso" ]);
    }
    
    public function excluir(){
        $dao = new CursoDAO();
        $dao->excluir($_REQUEST["id"]);
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/cursos/cadastro.html", 
                [ "mensagem" => "Excluído com sucesso" ]);
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
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/cursos/cadastro.html", 
                ["curso" => $c, "mensagem" => "Selecionado com sucesso" ]);
    }
}
?>