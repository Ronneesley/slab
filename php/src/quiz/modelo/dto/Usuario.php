<?php

namespace QuizEstatistico\modelo\dto;

/**
 * Classe que representa o usuário
 * @author Ronneesley
 */
class Usuario {
    private $id;
    
    private $nome;
    
    private $email;
    
    private $senha;
    
    public function getId() {
        return $this->id;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }
    
    public function getNome() {
        return $this->nome;
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

    public function setSenha($senha): void {
        $this->senha = $senha;
    }
}
?>