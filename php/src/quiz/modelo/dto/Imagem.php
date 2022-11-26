<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia uma imagem
 * Data Transfer Object (DTO)
 * @author Mayko
 */
class Imagem {
    private $id;
    
    private $imagem;

    private $identificador;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getIdentificador(){
        return $this->identificador;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setImagem($imagem): void {
        $this->imagem = $imagem;
    }

    public function setIdentificador($identificador): void {
        $this->identificador = $identificador;
    }

}

?>