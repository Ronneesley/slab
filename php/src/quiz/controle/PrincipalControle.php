<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\controle\QuizControle;

class PrincipalControle extends ControleBase {
    public function processar($controle, $acao){
        switch ($controle){
            case "principal":
                $this->processarPrincipal($acao);
                break;
            case "quiz":
                $controle = new QuizControle();
                $controle->processar($acao);
                break;
            case "conceito":
                $controle = new ConceitoControle();
                $controle->processar($acao);
                break;
            case "curso":
                $controle = new CursoControle();
                $controle->processar($acao);
                break;
            case "administrador":
                $controle = new AdministradorControle();
                $controle->processar($acao);
                break;
            case "imagem":
                $controle = new ImagemControle();
                $controle->processar($acao);
                break;
            case "nivel":
                $controle = new NivelControle();
                $controle->processar($acao);
                break;
            case "pergunta":
                $controle = new PerguntaControle();
                $controle->processar($acao);
                break;
            case "questao":
                $controle = new QuestaoControle();
                $controle->processar($acao);
                break;
            case "rank":
                $controle = new RankControle();
                $controle->processar($acao);
                break;
            case "tema":
                $controle = new TemaControle();
                $controle->processar($acao);
                break;
        }
    }
    
    public function processarPrincipal($acao){
        switch ($acao){
            case "inicio":
                $this->mostrarPaginaInicial();
                break;
            case "login":
                $this->mostrarPaginaLogin();
                break;
            case "logar":
                $this->logar();
                break;
            case "conteudos":
                $this->mostrarConteudos();
                break;
            default:
                $this->mostrarPaginaLogin();
                break;
        }        
    }
    
    public function logar(){
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];
        
        if ($email == "roni.teles@ifgoiano.edu.br" && $senha = "123456"){
            $this->mostrarPaginaInicial();
        } else {
            $this->mostrarPaginaLogin("Usuário ou senha incorretos");
        }
    }
    
    public function mostrarConteudos(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "conceitos/indice.html");
    }
    
    public function mostrarPaginaInicial(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "pagina_inicial.html");
    }
    
    public function mostrarPaginaLogin($mensagem = ""){
        $pagina = $this->configurarTemplate("login.html");
        $this->mostrarPagina($pagina, ["mensagem" => $mensagem]);
    }
}
?>