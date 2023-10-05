<?php
namespace QuizEstatistico\modelo;

/**
 * Classe responsável pelo cálculo teste de Tukey
 * @author Ronneesley Moura Teles
 */
class TesteTukey {

    private $tratamentos;
    
    private $leituras;

    private $I;

    private $J;

    private $K;

    private $C;

    private $L;

    private $G;

    private $GLTrat;
    
    private $SQTrat;

    private $QMTrat;

    private $SQBloco;

    private $GLBloco;

    private $QMBloco;

    private $FBlocoCalc;

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
    
        //Calculando o valor K
        $this->K = $this->G ** 2 / ($this->I * $this->J);
   
        //Calculando SQTotal
        $S = 0;
        for ($i = 0; $i < $this->I; $i++){
            for ($j = 0; $j < $this->J; $j++){
                $S += $this->converterNumero($leituras[$i][$j]) ** 2;
            }
        }
    
        $this->SQTotal = $S - $this->K;
    
        //Calculando SQTrat
        $S = 0;
        for ($i = 0; $i < $this->I; $i++){
            $S += $this->L[$i] ** 2;
        }
    
        $this->SQTrat = $S / $this->J - $this->K;

        //Calcula os valores calculados de F
        $this->FBlocoCalc = $this->QMBloco / $this->QMRes;    
        $this->FCalc = $this->QMTrat / $this->QMRes;

        $this->alfa = 0.05; //Nível de significância

        $this->FTab = 3.16; //Trabalho a ser feito

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
    
    public function getK() {
        return $this->K;
    }

    public function setK($K): void {
        $this->K = $K;
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

    public function getC(){
        return $this->C;
    }

    public function setC($C){
        $this->C = $C;
    }

    public function getSQBloco(){
        return $this->SQBloco;
    }

    public function setSQBloco($SQBloco){
        $this->SQBloco = $SQBloco;
    }

    public function getGLBloco(){
        return $this->GLBloco;
    }

    public function setGLBloco($GLBloco){
        $this->GLBloco = $GLBloco;
    }

    public function getQMBloco(){
        return $this->QMBloco;
    }

    public function setQMBloco($QMBloco){
        $this->QMBloco = $QMBloco;
    }

    public function getFBlocoCalc(){
        return $this->FBlocoCalc;
    }

    public function setFBlocoCalc($FBlocoCalc){
        $this->FBlocoCalc = $FBlocoCalc;
    }

    /**
     * Calcula a diferença mínima significativa de Tukey
     */
    public function calcularDelta($q, $qmRes, $r){
        return $q * sqrt($qmRes) / $r;
    }

    public function classificar($medias, $delta){
        //Ordena em ordem decrescente
        rsort($medias);

        //Determina a quantidade de tratamentos
        $n = count($medias);
        
        //Determina a letra inicial
        $letra = 'a';

        //Variável que guarda o resultado
        $resultado = array();
        for ($i = 0; $i < $n; $i++){
            array_push($resultado, array());
        }
        array_push($resultado[0], 'a');

        for ($i = 0; $i < $n - 1; $i++){
            $proximaLetra = chr(ord($letra) + 1);

            for ($j = $i + 1; $j < $n; $j++){
                $diferenca = $medias[$i] - $medias[$j];

                if ($diferenca > $delta){

                    $temLetrasDiferentes = false;
                    for ($k = 0; $k < count($resultado); $k++){
                        if (!in_array($resultado[$i][$k], $resultado[$j])){
                            $temLetrasDiferentes = true;
                            break;
                        }
                    }

                    //Elementos são diferentes
                    if ($temLetrasDiferentes){
                        array_push($resultado[$j], $proximaLetra);
                    }

                    $letra = $proximaLetra;
                    break;
                } else {
                    //Elementos são iguais
                    array_push($resultado[$j], $letra);
                }
            }
        }

        //Retorna o resultado
        return $resultado;
    }
}

?>