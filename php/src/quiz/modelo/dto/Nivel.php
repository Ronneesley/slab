<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um nivel
 * Data Transfer Object (DTO)
 * @author Mayko e Wagner
 */
class Nivel {
    private $id;
    
    private $nome;
        
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