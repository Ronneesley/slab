<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Usuario;
use QuizEstatistico\modelo\dao\UsuarioDAO;
use QuizEstatistico\modelo\dto\Curso;
use QuizEstatistico\modelo\dao\CursoDAO;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Controle de ações relacionadas com usuários
 * @author Ronneesley Moura Teles
 */
class UsuarioControle extends ControleBase {    
    public function processar($acao){
        switch ($acao){
            case "novo":
                if ($this->estaLogado()){
                    $this->mostrarFormularioCadastro();
                    break;
                }else{
                    $p = new PrincipalControle();
                    $p->mostrarPaginaLogin("Faça login primeiro!");
                }
            case "esqueci_senha":
                $this->mostrarFormularioEsqueciSenha();
                break;
            case "cadastre_se":
                $this->mostrarFormularioCadastreSe();
                break;
            case "inserir_novo":
                $this->inserir_novo();
                break;
            case "salvar":
                if ($this->estaLogado()){
                    $this->salvar();
                    break;
                }else{
                    $p = new PrincipalControle();
                    $p->mostrarPaginaLogin("Faça login primeiro!");
                }
            case "inserir":
                if ($this->estaLogado()){
                    $this->inserir();
                    break;
                }else{
                    $p = new PrincipalControle();
                    $p->mostrarPaginaLogin("Faça login primeiro!");
                }
            case "alterar":
                if ($this->estaLogado()){
                    $this->alterar();
                    break;
                }else{
                    $p = new PrincipalControle();
                    $p->mostrarPaginaLogin("Faça login primeiro!");
                }
            case "listar":
                if ($this->estaLogado()){
                    $this->listar();
                    break;
                }else{
                    $p = new PrincipalControle();
                    $p->mostrarPaginaLogin("Faça login primeiro!");
                }
            case "excluir":
                if ($this->estaLogado()){
                    $this->excluir();
                    break;
                }else{
                    $p = new PrincipalControle();
                    $p->mostrarPaginaLogin("Faça login primeiro!");
                }
            case "selecionar":
                if ($this->estaLogado()){
                    $this->selecionar();
                    break;
                }else{
                    $p = new PrincipalControle();
                    $p->mostrarPaginaLogin("Faça login primeiro!");
                }
        }
    }
    
    public function salvar(){
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != ""){
            $this->alterar();            
        } else {
            $this->inserir();
        }
    }

    public function mostrarFormularioCadastreSe($usuario = new Usuario(), 
        $mensagem = "", $tipo_mensagem = ""){
        $cursoDAO = new CursoDAO();
        $cursos = $cursoDAO->listar();
        
        $pagina = $this->configurarTemplate("cadastre_se.html");
        $this->mostrarPagina($pagina,["usuario" => $usuario, "mensagem" => $mensagem, 
                  "tipo_mensagem" => $tipo_mensagem,
                  "cursos" => $cursos ]);
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

        if ($dao != false){
            $this->mostrarFormularioCadastro($u, "Inserido com sucesso!");
        }else{
            $this->mostrarFormularioCadastreSe($u, "Erro: E-mail já em uso!", "error");
        }
        
    }

     public function inserir_novo(){
        $u = new Usuario();
        $u->setNome($_REQUEST["nome"]);
        $u->setEmail($_REQUEST["email"]);
        $u->setLogin($_REQUEST["login"]);
        $u->setSenha($_REQUEST["senha"]);
        $u->setCurso(new Curso($_REQUEST["curso"]));

        $dao = new UsuarioDAO();
        $inserir = $dao->inserir($u);

        if ($inserir === false) {
            $this->mostrarFormularioCadastreSe(null, "Falha: E-mail já está em uso", "error");
        } else {
            $this->mostrarFormularioCadastreSe($u, "Cadastrado com sucesso!", "success");
        }
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