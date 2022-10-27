<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um rank
 * Data Transfer Object (DTO)
 * @author Wagner e Mayko
 */
class Rank {
    private $id;
    
    private $nome;

    private $pontuacao;

    private $acerto;

    private $erro;

    private $curso;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPontuacao() {
        return $this->pontuacao;
    }

    public function getAcerto() {
        return $this->acerto;
    }

    public function getErro() {
        return $this->erro;
    }

    public function getCurso() {
        return $this->curso;
    }

    
    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setPontuacao($pontuacao): void {
        $this->pontuacao = $pontuacao;
    }

    public function setAcerto($acerto): void {
        $this->acerto = $acerto;
    }

    public function setErro($erro): void {
        $this->erro = $erro;
    }

    public function setCurso($curso): void {
        $this->curso = $curso;
    }
}

?>