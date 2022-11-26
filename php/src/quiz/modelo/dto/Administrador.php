<?php
namespace QuizEstatistico\modelo\dto;

/**
 * Esta classe mapeia um Administrador
 * Data Transfer Object (DTO)
 * @author Wagner e Mayko
 */
class Administrador {

    private $id;
    
    private $nome;

    private $email;

    private $senha;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getSenha() {
        return $this->senha;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setSenha($senha): void {
        $this->senha = $senha;
    }



}

?>