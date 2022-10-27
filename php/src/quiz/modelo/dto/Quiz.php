<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um quiz
 * Data Transfer Object (DTO)
 * @author Wagner e Mayko
 */
class Quiz {
    private $id;
    
    private $nome_quiz;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome_quiz() {
        return $this->nome_quiz;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome_quiz($nome_quiz): void {
        $this->nome_quiz = $nome_quiz;
    }

}

?>