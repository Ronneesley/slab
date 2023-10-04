<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um quiz
 * Data Transfer Object (DTO)
 * @author Wagner, Mayko, Ronneesley
 */
class Quiz {
    private $id;
    
    private $nome;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }
}

?>