<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um tema
 * Data Transfer Object (DTO)
 * @author Wagner e Mayko
 */
class Tema {
    private $id;
    
    private $tema;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTema() {
        return $this->tema;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTema($tema): void {
        $this->tema = $tema;
    }

}

?>