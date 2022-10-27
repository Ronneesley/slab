<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um Questão
 * Data Transfer Object (DTO)
 * @author Mayko e Wagner
 */
class Questao {
    private $id;
    
    private $nivel;

    private $curso;

    private $tema;

    private $pergunta;

    private $resposta_certa;

    private $resposta_errada1;

    private $resposta_errada2;

    private $resposta_errada3;

    private $explicacao;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getNivel() {
        return $this->nivel;
    }
    public function getTema() {
        return $this->tema;
    }
    public function getPergunta() {
        return $this->pergunta;
    }
    public function getExplicacao() {
        return $this->explicacao;
    }
    public function getResposta_certa() {
        return $this->resposta_certa;
    }
    public function getResposta_errada1() {
        return $this->resposta_errada1;
    }
    public function getResposta_errada2() {
        return $this->resposta_errada2;
    }    
    public function getResposta_errada3() {
        return $this->resposta_errada3;
    }



    public function setId($id): void {
        $this->id = $id;
    }

    public function setNivel($nivel): void {
        $this->nivel = $nivel;
    }   
     public function setCurso($curso): void {
        $this->curso = $curso;
    }    
    public function setTema($tema): void {
        $this->tema = $tema;
    }    
    public function setPergunta($pergunta): void {
        $this->pergunta = $pergunta;
    }   
    public function setResposta_certa($resposta_certa): void {
        $this->resposta_certa = $resposta_certa;
    }
    
    public function setResposta_errada1($resposta_errada1): void {
        $this->resposta_errada1 = $resposta_errada1;
    }

    public function setResposta_errada2($resposta_errada2): void {
        $this->resposta_errada2 = $resposta_errada2;
    }

    public function setResposta_errada3($resposta_errada3): void {
        $this->resposta_errada3 = $resposta_errada3;
    }
    public function setExplicacao($explicacao): void {
        $this->explicacao = $explicacao;
    }



}

?>