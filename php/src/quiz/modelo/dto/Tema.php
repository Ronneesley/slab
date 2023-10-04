<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um tema
 * Data Transfer Object (DTO)
 * @author Wagner, Mayko, Ronneesley
 */
class Tema {
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