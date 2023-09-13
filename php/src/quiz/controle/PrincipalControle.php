<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\controle\QuizControle;
use QuizEstatistico\controle\AdministradorControle;
use QuizEstatistico\controle\CalculadoraControle;
use QuizEstatistico\controle\UsuarioControle;
use QuizEstatistico\controle\DelineamentosControle;
use QuizEstatistico\modelo\dao\QuizDAO;

class PrincipalControle extends ControleBase {

    public function processarControles($controle, $acao) {
        switch ($controle) {
            case "principal":
                $this->processar($acao);
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
            case "usuario":
                $controle = new UsuarioControle();
                $controle->processar($acao);
                break;
            case "calculadora":
                $controle = new CalculadoraControle();
                $controle->processar($acao);
                break;
            case "delineamentos":
                $controle = new DelineamentosControle();
                $controle->processar($acao);
                break;
            case "terminalinterativo":
                $controle = new TerminalInterativoControle();
                $controle->processar($acao);
                break;
        }
    }

    public function processar($acao) {
        switch ($acao) {
            case "inicio":
                $this->mostrarPaginaInicial();
                break;
            case "login":
                $this->mostrarPaginaLogin();
                break;
            case "logar":
                $this->logar();
                break;
            case "quiz":
                $this->mostrarPaginaInicialQuiz();
                break;
            case "conteudos":
                $this->mostrarConteudos();
                break;
            case "expediente":
                $this->mostrarPaginaExpediente();
                break;
            case "testar_conexao":
                $this->testarConexao();
                break;
            default:                
                $this->mostrarPaginaVerificacaoInstalacao();
                break;
        }
    }
    
    public function testarConexao(){
        $servidor = $_POST["servidor"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        $bancoDados = $_POST["banco_dados"];
        $porta = $_POST["porta"];
            
        $dao = new QuizDAO();
        
        $pagina = $this->configurarTemplate("erros/verificacao_instalacao.html");
        
        try {            
            $dao->realizar_conexao($servidor, $usuario, $senha, $bancoDados, $porta);
            
            $this->mostrarPagina($pagina, 
                    ["mensagem" => "Conexão realizada com sucesso",
                     "tipo_mensagem" => "success"]);
        } catch (\Exception $ex){
            /*$config = $dao->getConfiguracoes();
            
            $this->mostrarPagina($pagina, 
                    ["mensagem" => $ex->getMessage(), 
                     "config" => $config]);*/
        }
    }
    
    public function mostrarPaginaVerificacaoInstalacao(){
        $dao = new QuizDAO();
        
        try {            
            $dao->conectar();
            
            $this->mostrarPaginaLogin();
        } catch (\Exception $ex){
            $pagina = $this->configurarTemplate("erros/verificacao_instalacao.html");
            
            $config = $dao->getConfiguracoes();
            
            $this->mostrarPagina($pagina, 
                    ["mensagem" => $ex->getMessage(), 
                     "tipo_mensagem" => "danger",
                     "config" => $config]);
        }
    }
 
    
    public function mostrarPaginaExpediente(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "expediente.html");
    }

    public function logar() {
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];

        if ($email == "usuario@gmail.com" && $senha == "123456") {
            $this->mostrarPaginaInicial();
        } else {
            $this->mostrarPaginaLogin("Usuário ou senha incorretos");
        }
    }

    public function mostrarConteudos() {
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "conceitos/indice.html");
    }

    public function mostrarPaginaInicial() {
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "pagina_inicial.html");
    }
    
    public function mostrarPaginaInicialQuiz() {
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "inicio_quiz.html");
    }

    public function mostrarPaginaLogin($mensagem = "") {
        $pagina = $this->configurarTemplate("login.html");
        $this->mostrarPagina($pagina, ["mensagem" => $mensagem]);
    }
}
?>
