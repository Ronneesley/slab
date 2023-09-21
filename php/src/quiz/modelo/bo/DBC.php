<?php

namespace QuizEstatistico\modelo\bo;

/**
 * Delineamento em Blocos Casualizados (DBC)
 * Autor: Ronneesley Moura Teles
 * 
 * Referências:
 * https://www.fcav.unesp.br/Home/departamentos/cienciasexatas/AMANDALIZPACIFICOMANFRIM/dbc.pdf
 */
class DBC {
    private $tratamentos;
    
    private $leituras;

    private $I;

    private $J;

    private $C;

    private $L;

    private $G;

    private $GLTrat;
    
    private $SQTrat;

    private $QMTrat;

    private $FCalc;

    private $GLRes;

    private $SQRes;

    private $QMRes;

    private $GLTotal;

    private $SQTotal;

    private $conclusao;

    private $alfa;

    private $FTab;

    function converterNumero($numero_em_string){
        return floatval(strtr($numero_em_string, ",", "."));
    }

    public function calcular($tratamentos, $leituras, $J){
        $this->J = $J;
        $this->tratamentos = $tratamentos;
        $this->leituras = $leituras;

        $this->I = count($tratamentos);

        $this->L = array();
        for ($i = 0; $i < $this->I; $i++){
            $S = 0;
            for ($j = 0; $j < $J; $j++){
                $S += $this->converterNumero($leituras[$i][$j]);
            }
    
            $this->L[$i] = $S;
        }
    
        $this->G = 0;
        for ($i = 0; $i < $this->I; $i++){
            $this->G += $this->L[$i];
        }
    
        //Calculando o valor C
        $this->C = $this->G ** 2 / ($this->I * $this->J);
   
        //Calculando SQTotal
        $S = 0;
        for ($i = 0; $i < $this->I; $i++){
            for ($j = 0; $j < $this->J; $j++){
                $S += $this->converterNumero($leituras[$i][$j]) ** 2;
            }
        }
    
        $this->SQTotal = $S - $this->C;
    
        //Calculando SQTrat
        $S = 0;
        for ($i = 0; $i < $this->I; $i++){
            $S += $this->L[$i] ** 2;
        }
    
        $this->SQTrat = $S / $this->J - $this->C;
    
        //Calculando SQRes
        $this->SQRes = $this->SQTotal - $this->SQTrat;
    
        $this->GLTrat = $this->I - 1;
        $this->GLRes = $this->I * ($this->J - 1);
    
        $this->GLTotal = $this->I * $this->J - 1;
    
        $this->QMTrat = $this->SQTrat / $this->GLTrat;
        $this->QMRes = $this->SQRes / $this->GLRes;
    
        $this->FCalc = $this->QMTrat / $this->QMRes;

        $this->alfa = 0.05; //Nível de significância

        $this->FTab = 2.87; //Trabalho a ser feito

        if ($this->FCalc < $this->FTab){
            $this->conclusao = "O teste é não significativo ao nível de significância de $this->alfa. Aceitamos H0.";
        } else {
            $this->conclusao = "O teste é significativo ao nível de significância de $this->alfa. Rejeita H0 em Favor de H1.";
        }
    }
    
    public function getI() {
        return $this->I;
    }

    public function getJ() {
        return $this->J;
    }

    public function getL() {
        return $this->L;
    }

    public function getG() {
        return $this->G;
    }

    public function getGLTrat() {
        return $this->GLTrat;
    }

    public function getSQTrat() {
        return $this->SQTrat;
    }

    public function getQMTrat() {
        return $this->QMTrat;
    }

    public function getFCalc() {
        return $this->FCalc;
    }

    public function getGLRes() {
        return $this->GLRes;
    }

    public function getSQRes() {
        return $this->SQRes;
    }

    public function getQMRes() {
        return $this->QMRes;
    }

    public function getGLTotal() {
        return $this->GLTotal;
    }

    public function getSQTotal() {
        return $this->SQTotal;
    }

    public function getConclusao() {
        return $this->conclusao;
    }

    public function setI($I): void {
        $this->I = $I;
    }

    public function setJ($J): void {
        $this->J = $J;
    }

    public function setL($L): void {
        $this->L = $L;
    }

    public function setG($G): void {
        $this->G = $G;
    }

    public function setGLTrat($GLTrat): void {
        $this->GLTrat = $GLTrat;
    }

    public function setSQTrat($SQTrat): void {
        $this->SQTrat = $SQTrat;
    }

    public function setQMTrat($QMTrat): void {
        $this->QMTrat = $QMTrat;
    }

    public function setFCalc($FCalc): void {
        $this->FCalc = $FCalc;
    }

    public function setGLRes($GLRes): void {
        $this->GLRes = $GLRes;
    }

    public function setSQRes($SQRes): void {
        $this->SQRes = $SQRes;
    }

    public function setQMRes($QMRes): void {
        $this->QMRes = $QMRes;
    }

    public function setGLTotal($GLTotal): void {
        $this->GLTotal = $GLTotal;
    }

    public function setSQTotal($SQTotal): void {
        $this->SQTotal = $SQTotal;
    }

    public function setConclusao($conclusao): void {
        $this->conclusao = $conclusao;
    }
    
    public function getC() {
        return $this->C;
    }

    public function setC($C): void {
        $this->C = $C;
    }
    
    public function getAlfa() {
        return $this->alfa;
    }

    public function getFTab() {
        return $this->FTab;
    }

    public function setAlfa($alfa): void {
        $this->alfa = $alfa;
    }

    public function setFTab($FTab): void {
        $this->FTab = $FTab;
    }
    
    public function getTratamentos() {
        return $this->tratamentos;
    }

    public function getLeituras() {
        return $this->leituras;
    }

    public function setTratamentos($tratamentos): void {
        $this->tratamentos = $tratamentos;
    }

    public function setLeituras($leituras): void {
        $this->leituras = $leituras;
    }
}

?>