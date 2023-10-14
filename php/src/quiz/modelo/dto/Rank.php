<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um rank
 * Data Transfer Object (DTO)
 * @author Wagner e Mayko
 */
class Rank {
    private $id;

    private $pontuacao;

    private $acerto;

    private $erro;

    private $usuario;
    
    private $quiz;

    private $utils;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
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

    public function getUsuario() {
        return $this->usuario;
    }

    public function getQuiz() {
        return $this->quiz;
    }

    public function getUtils() {
        return $this->utils;
    }

    
    public function setId($id): void {
        $this->id = $id;
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

    public function setUsuario($usuario): void {
        $this->usuario = $usuario;
    }

    public function setQuiz($quiz): void {
        $this->quiz = $quiz;
    }

    public function setUtils($utils): void {
        $this->utils = $utils;
    }
}

?>