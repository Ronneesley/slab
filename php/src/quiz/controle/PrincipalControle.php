<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\controle\QuizControle;
use QuizEstatistico\controle\AdministradorControle;
use QuizEstatistico\controle\CalculadoraControle;
use QuizEstatistico\controle\UsuarioControle;
use QuizEstatistico\controle\DelineamentosControle;
use QuizEstatistico\controle\TesteFControle;
use QuizEstatistico\controle\TesteTukeyControle;
use QuizEstatistico\modelo\dao\QuizDAO;
use QuizEstatistico\modelo\dao\UsuarioDAO;

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
            case "teste_f":
                $controle = new TesteFControle();
                $controle->processar($acao);
                break;
            case "teste_tukey":
                $controle = new TesteTukeyControle();
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
            case "mostrar_pagina_configuracao":
                $this->mostrarPaginaVerificacaoInstalacao();
                break;
            case "salvar_configuracao":
                $this->salvarConfiguracao();
                break;
            default:                
                $this->mostrarPaginaVerificacaoInstalacao();
                break;
        }
    }

    public function salvarConfiguracao(){
        $dao = new QuizDAO();
        $config = $dao->getConfiguracoes();

        if ($config->modo_instalacao){
            try {            
                $servidor = $_POST["servidor"];
                $usuario = $_POST["usuario"];
                $senha = $_POST["senha"];
                $bancoDados = $_POST["banco_dados"];
                $porta = $_POST["porta"];

                $dao->realizar_conexao($servidor, $usuario, $senha, $bancoDados, $porta);

                $json = array("servidor" => $servidor,
                    "usuario" => $usuario,
                    "senha" => $senha,
                    "banco_dados" => $bancoDados,
                    "porta" => intval($porta),
                    "modo_instalacao" => false);

                $f = fopen("configuracoes.json", "w");
                fwrite($f, json_encode($json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                fclose($f);
                
                $this->mostrarPaginaLogin();
            } catch (\Exception $ex) {
                $pagina = $this->configurarTemplate("instalacao/verificacao_instalacao.html");

                $this->mostrarPagina($pagina,
                        ["mensagem" => "Não é possível salvar configurações defeituosas. Erro: " . $ex->getMessage(),
                        "tipo_mensagem" => "danger",
                        "usuario" => $usuario,
                        "senha" => $senha,
                        "servidor" => $servidor,
                        "porta" => $porta,
                        "banco_dados" => $bancoDados,
                        ]);
            }
        } else {
            $pagina = $this->configurarTemplate("erros/configuracoes_nao_podem_ser_alteradas.html");
        }
    }
    
    public function testarConexao(){
        $servidor = $_POST["servidor"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        $bancoDados = $_POST["banco_dados"];
        $porta = $_POST["porta"];
            
        $dao = new QuizDAO();
        
        $pagina = $this->configurarTemplate("instalacao/verificacao_instalacao.html");
        
        try {            
            $dao->realizar_conexao($servidor, $usuario, $senha, $bancoDados, $porta);

            $mensagem = "Conexão realizada com sucesso";
            $tipo = "success";
        } catch (\Exception $ex){            
            $mensagem = $ex->getMessage();
            $tipo = "danger";
        }

        $this->mostrarPagina($pagina,
                    ["mensagem" => $mensagem,
                     "tipo_mensagem" => $tipo,
                     "usuario" => $usuario,
                     "senha" => $senha,
                     "servidor" => $servidor,
                     "porta" => $porta,
                     "banco_dados" => $bancoDados,
                    ]);
    }
    
    public function mostrarPaginaVerificacaoInstalacao(){
        $dao = new QuizDAO();
        
        try {            
            $dao->conectar();            
            
            $this->mostrarPaginaLogin();
        } catch (\Exception $ex){
            $pagina = $this->configurarTemplate("instalacao/verificacao_instalacao.html");
            
            $config = $dao->getConfiguracoes();

            if ($config->modo_instalacao){            
                $this->mostrarPagina($pagina, 
                        ["mensagem" => $ex->getMessage(), 
                        "tipo_mensagem" => "danger",
                        "usuario" => $config->usuario,
                        "senha" => $config->senha,
                        "servidor" => $config->servidor,
                        "porta" => $config->porta,
                        "banco_dados" => $config->banco_dados,
                        ]);
            } else {
                $pagina = $this->configurarTemplate("erros/problema_geral.html");
                $this->mostrarPagina($pagina, ["mensagem" => "Não foi possível conectar com o banco de dados, contate o administrador"]);
            }
        }
    } 
    
    public function mostrarPaginaExpediente(){
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "expediente.html");
    }

    public function logar() {
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];

        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->logar($email, $senha);

        if ($usuario != null){
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
