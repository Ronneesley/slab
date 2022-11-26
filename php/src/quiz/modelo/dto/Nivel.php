<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um nivel
 * Data Transfer Object (DTO)
 * @author Mayko e Wagner
 */
class Nivel {
    private $id;
    
    private $nivel;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNivel($nivel): void {
        $this->nivel = $nivel;
    }

}

?>