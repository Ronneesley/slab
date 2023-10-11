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

    private $curso;

    private $login;

    public function getPrimeiroNome(){
        return explode(" ", $this->nome)[0];
    }
    
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

    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso): void {
        $this->curso = $curso;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login): void {
        $this->login = $login;
    }
}
?>