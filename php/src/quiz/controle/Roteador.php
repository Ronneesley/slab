<?php

namespace QuizEstatistico\controle;

use QuizEstatistico\controle\PrincipalControle;
use QuizEstatistico\controle\QuizControle;
use QuizEstatistico\controle\AdministradorControle;
use QuizEstatistico\controle\CalculadoraControle;
use QuizEstatistico\controle\UsuarioControle;
use QuizEstatistico\controle\DICControle;
use QuizEstatistico\controle\DBCControle;
use QuizEstatistico\controle\TesteFControle;
use QuizEstatistico\controle\TesteTukeyControle;

class Roteador {
    public function processarControles($controle, $acao) {
        switch ($controle) {
            case "principal":
                $controle = new PrincipalControle();
                $controle->processar($acao);
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
            case "dic":
                $controle = new DICControle();
                $controle->processar($acao);
                break;
            case "dbc":
                $controle = new DBCControle();
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
            case "amplitude_total":
                $controle = new AmplitudeTotalControle();
                $controle->processar($acao);
                break;
        }
    }
}
?>