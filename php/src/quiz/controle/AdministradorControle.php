<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\controle\ControleBase;
use QuizEstatistico\modelo\dto\Administrador;
use QuizEstatistico\modelo\dao\AdministradorDAO;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Description of AdministradorControle
 *
 * @author Wagner e Mayko
 */
class AdministradorControle extends ControleBase {    
    public function processar($acao){
        switch ($acao){
            case "painel":
                $this->mostrarPainelAdministrativo();
                break;
            case "login":
                $this->mostrarPaginaLogin();
                break;
            case "deslogar":
                $this->deslogar();
                break;
            case "logar":
                $this->logar();
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
            case "novo":
                $this->mostrarFormularioCadastro();
                break;
        }
    }

    public function mostrarFormularioCadastro(){
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/administradores/cadastro.html");
    }
    
    public function deslogar(){
        @session_destroy();
        
        $controle = new PrincipalControle();
        $controle->mostrarPaginaLogin();
    }
    
    public function logar() {
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];

        if ($email == "admin@gmail.com" && $senha = "123456") {
            $this->mostrarPainelAdministrativo();
        } else {
            $this->mostrarPaginaLogin("Usuário ou senha incorretos");
        }
    }

    public function mostrarPainelAdministrativo(){
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/painel.html");
    }

    public function mostrarPaginaLogin($mensagem = ""){
        $pagina = $this->configurarTemplate("admin/login.html");
        $this->mostrarPagina($pagina, ["mensagem" => $mensagem]);
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
?>