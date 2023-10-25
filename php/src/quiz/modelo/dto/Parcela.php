<?php
namespace QuizEstatistico\modelo\dto;

class Parcela {
    private $tratamento;

    private $repeticao;

    public function __construct($tratamento, $repeticao)
    {
        $this->tratamento = $tratamento;
        $this->repeticao = $repeticao;
    }

    public function getRepeticao(){
        return $this->repeticao;
    }

    public function setRepeticao($repeticao){
        $this->repeticao = $repeticao;
    }

    public function getTratamento(){
        return $this->tratamento;
    }

    public function setTratamento($tratamento){
        $this->tratamento = $tratamento;
    }
}
?>