<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Usuario;
use QuizEstatistico\modelo\dao\UsuarioDAO;
use QuizEstatistico\modelo\dto\Curso;
use QuizEstatistico\modelo\dao\CursoDAO;

/**
 * Controle de ações relacionadas com usuários
 * @author Ronneesley Moura Teles
 */
class UsuarioControle extends ControleBase {    
    public function processar($acao){
        switch ($acao){
            case "novo":
                $this->mostrarFormularioCadastro();
                break;
            case "esqueci_senha":
                $this->mostrarFormularioEsqueciSenha();
                break;
            case "cadastre_se":
                $this->mostrarFormularioCadastreSe();
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

    public function mostrarFormularioCadastreSe(){
        $pagina = $this->configurarTemplate("cadastre_se.html");
        $this->mostrarPagina($pagina);
    }
    
    public function mostrarFormularioCadastro(
        $usuario = new Usuario(), 
        $mensagem = "", $tipo_mensagem = "success"){

        $cursoDAO = new CursoDAO();
        $cursos = $cursoDAO->listar();

        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/usuarios/cadastro.html", 
                [ "usuario" => $usuario, "mensagem" => $mensagem, 
                  "tipo_mensagem" => $tipo_mensagem,
                  "cursos" => $cursos ]);
    }
    
    public function mostrarFormularioEsqueciSenha($mensagem = ""){
        $pagina = $this->configurarTemplate("esqueci_senha.html");
        $this->mostrarPagina($pagina, ["mensagem" => $mensagem]);
    }
    
    public function inserir(){
        $u = new Usuario();
        $u->setNome($_REQUEST["nome"]);
        $u->setEmail($_REQUEST["email"]);
        $u->setLogin($_REQUEST["login"]);
        $u->setSenha($_REQUEST["senha"]);
        $u->setCurso(new Curso($_REQUEST["curso"]));

        $dao = new UsuarioDAO();
        $dao->inserir($u);
        
        $this->mostrarFormularioCadastro($u, "Inserido com sucesso");
    }
    
    public function alterar(){
        $u = new Usuario();
        $u->setId($_REQUEST["id"]);
        $u->setNome($_REQUEST["nome"]);
        $u->setEmail($_REQUEST["email"]);
        $u->setLogin($_REQUEST["login"]);
        $u->setCurso(new Curso($_REQUEST["curso"]));

        $dao = new UsuarioDAO();
        $dao->alterar($u);
        
        $this->mostrarFormularioCadastro($u, "Alterado com sucesso");
    }
    
    public function excluir(){
        $dao = new UsuarioDAO();
        $dao->excluir($_REQUEST["id"]);
        
        $this->listar("Excluído com sucesso");
    }
    
    public function listar($mensagem = "", $tipo_mensagem = "success"){
        $dao = new UsuarioDAO();
        $lista = $dao->listar();

        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/usuarios/listagem.html", 
            ["mensagem" => $mensagem, "lista" => $lista,
            "tipo_mensagem" => $tipo_mensagem ]);
    }
    
    public function selecionar(){
        $dao = new UsuarioDAO();
        $u = $dao->selecionar($_REQUEST["id"]);
        
        $this->mostrarFormularioCadastro($u, "Selecionado com sucesso");
    }
}
?>