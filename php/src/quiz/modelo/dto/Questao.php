<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um Questão
 * Data Transfer Object (DTO)
 * @author Mayko, Wagner, Ronneesley
 */
class Questao {
    private $id;
    
    private $nivel;

    private $curso;

    private $tema;

    private $pergunta;

    private $respostaCerta;

    private $respostaErrada1;

    private $respostaErrada2;

    private $respostaErrada3;

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
    public function getRespostaCerta() {
        return $this->respostaCerta;
    }
    public function getRespostaErrada1() {
        return $this->respostaErrada1;
    }
    public function getRespostaErrada2() {
        return $this->respostaErrada2;
    }    
    public function getRespostaErrada3() {
        return $this->respostaErrada3;
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
    
    public function setRespostaCerta($respostaCerta): void {
        $this->respostaCerta = $respostaCerta;
    }
    
    public function setRespostaErrada1($respostaErrada1): void {
        $this->respostaErrada1 = $respostaErrada1;
    }

    public function setRespostaErrada2($respostaErrada2): void {
        $this->respostaErrada2 = $respostaErrada2;
    }

    public function setRespostaErrada3($respostaErrada3): void {
        $this->respostaErrada3 = $respostaErrada3;
    }

    public function setExplicacao($explicacao): void {
        $this->explicacao = $explicacao;
    }
}
?>