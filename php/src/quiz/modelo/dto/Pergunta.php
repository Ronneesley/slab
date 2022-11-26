<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um Pergunta
 * Data Transfer Object (DTO)
 * @author Mayko e Wagner
 */
class Pergunta {
    private $id;
    
    private $questao;

    private $quiz;

    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getQuestao() {
        return $this->questao;
    }
    public function getQuiz() {
        return $this->quiz;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setQuestao($questao): void {
        $this->questao = $questao;
    }    
    public function setQuiz($quiz): void {
        $this->quiz = $quiz;
    }

}

?>