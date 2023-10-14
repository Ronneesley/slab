<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dao\QuizDAO;
use QuizEstatistico\modelo\dao\UsuarioDAO;

class PrincipalControle extends ControleBase {

    public function processar($acao) {
        switch ($acao) {
            //Ações que não precisam de login
            case "login":
                $this->mostrarPaginaLogin();
                break;
            case "logar":
                $this->logar();
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
            //Ações que precisam de login
            case "inicio":
                if ($this->estaLogado()){
                    $this->mostrarPaginaInicial();
                    break;
                }else{
                    $this->mostrarPaginaLogin("Faça login primeiro!");
                    break;
                }
            case "inicio_rank":
                if ($this->estaLogado()){
                    $this->mostrarPaginaInicialRank();
                    break;
                }else{
                    $this->mostrarPaginaLogin("Faça login primeiro!");
                    break;
                }
            case "deslogar":
                if ($this->estaLogado()){
                    $this->deslogar();
                    break;
                }else{
                    $this->mostrarPaginaLogin("Faça login primeiro!");
                    break;
                }
            case "conteudos":
                if ($this->estaLogado()){
                    $this->mostrarConteudos();
                    break;
                }else{
                    $this->mostrarPaginaLogin("Faça login primeiro!");
                    break;
                }
            case "expediente":
                if ($this->estaLogado()){
                    $this->mostrarPaginaExpediente();
                    break;
                }else{
                    $this->mostrarPaginaLogin("Faça login primeiro!");
                    break;
                }
            default:
                if ($this->configuracaoEstaCorreta()) $this->mostrarPaginaVerificacaoInstalacao();
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

    private function configuracaoEstaCorreta(){
        $dao = new QuizDAO();
        
        try {            
            return true;
        } catch (\Exception $ex){
            return false;
        }
    }
    
    public function mostrarPaginaVerificacaoInstalacao(){
        $dao = new QuizDAO();
        
        try {            
            $dao->conectar();
            
            if($this->estaLogado()){
                $this->mostrarPaginaInicial();
            }else{
                $this->mostrarPaginaLogin();
            }
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
            $_SESSION["usuario"] = $usuario;

            $this->mostrarPaginaInicial();
        } else {
            $this->mostrarPaginaLogin("Usuário ou senha incorretos");
        }
    }

    public function deslogar(){
        session_destroy();

        $this->mostrarPaginaLogin();
    }

    public function mostrarConteudos() {
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "conceitos/indice.html");
    }

    public function mostrarPaginaInicial() {
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "pagina_inicial.html");
    }

    public function mostrarPaginaInicialRank() {
        $layout = $this->configurarTemplate("layout.html");
        $this->mostrarPaginaLayout($layout, "ranking_acertos.html");
    }

    public function mostrarPaginaLogin($mensagem = "") {
        $pagina = $this->configurarTemplate("login.html");
        $this->mostrarPagina($pagina, ["mensagem" => $mensagem]);
    }
}
?>