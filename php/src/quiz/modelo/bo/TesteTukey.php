<?php
namespace QuizEstatistico\modelo\bo;

/**
 * Classe responsável pelo cálculo teste de Tukey
 * @author Ronneesley Moura Teles
 */
class TesteTukey {
    private $delta;

    private $classes;

    private $indices;

    private $mediasOrdenadas;

    private $nTratamentos;

    private $nClasses;

    public function temClasse($iO, $nC){
        return in_array($this->getNomeClasse($nC), $this->classes[$iO]);
    }

    public function getNomeClasse($nC){
        return chr($nC + 96);
    }

    public function calcular($medias, $q, $qmRes, $r){
        $this->setDelta($this->calcularDelta($q, $qmRes, $r));

        //Ordena em ordem decrescente
        $mediasO = $medias;
        arsort($mediasO);

        $this->indices = array_keys($mediasO);
        $this->mediasOrdenadas = array_values($mediasO);

        //Determina a quantidade de tratamentos
        $this->nTratamentos = count($this->mediasOrdenadas);

        list($c, $nC) = $this->classificar($this->mediasOrdenadas, $this->delta);

        $this->setClasses($c);
        $this->setNClasses($nC);
    }

    /**
     * Calcula a diferença mínima significativa de Tukey
     */
    public function calcularDelta($q, $qmRes, $r){
        return $q * sqrt($qmRes / $r);
    }
  

    /**
     * Classifica as médias
     * 
     * @param $mediasO são as médias ordenadas
     * 
     * Fontes:
     * https://www.youtube.com/watch?v=9qNXNPqKrAc&ab_channel=JefersonRibeiro
     */
    public function classificar($mediasO, $delta){
        //Determina a quantidade de tratamentos
        $n = count($mediasO);

        //Variável que guarda o resultado
        $resultado = array();
        for ($i = 0; $i < $n; $i++){
            array_push($resultado, array());
        }

        //Determina a letra inicial
        $letra = 'a';
        $nClasses = 1;

        for ($i = 0; $i < $n; $i++){            
            $teveElementoIgual = false;
            $atribuiuLetra = false;
            
            for ($j = $i + 1; $j < $n; $j++){
                //Calcula o valor absoluto da diferença
                $diferenca = abs($mediasO[$i] - $mediasO[$j]);

                //Se são iguais
                if ($diferenca <= $delta){
                    $compartilhamMesmaLetra = false;

                    for ($k = 0; $k < count($resultado[$i]); $k++){
                        if (in_array($resultado[$i][$k], $resultado[$j])){
                            $compartilhamMesmaLetra = true;
                            break;
                        }
                    }

                    if (!$compartilhamMesmaLetra){
                        if (!$atribuiuLetra) {
                            array_push($resultado[$i], $letra);
                            $atribuiuLetra = true;
                        }

                        //Elementos são iguais
                        array_push($resultado[$j], $letra);

                        //Marca que houve um elemento igual
                        $teveElementoIgual = true;
                    }
                } else {
                    break;
                }
            }

            //Se não teve elemento igual ao primeiro
            if ($teveElementoIgual){
                $letra = chr(ord($letra) + 1);
            } else {
                if (empty($resultado[$i])){
                    array_push($resultado[$i], $letra);

                    $letra = chr(ord($letra) + 1);
                }
            }     
        }

        /*print("<pre>");
        print_r($resultado);
        print("</pre>");*/

        //Calcula o número de classes ao final do processo
        $nClasses = ord($letra) - ord('a');

        //Retorna o resultado
        return array($resultado, $nClasses);
    }

    /**
     * Get the value of delta
     */ 
    public function getDelta()
    {
        return $this->delta;
    }

    /**
     * Set the value of delta
     */ 
    public function setDelta($delta)
    {
        $this->delta = $delta;
    }

    /**
     * Get the value of classes
     */ 
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Set the value of classes
     */ 
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }

    /**
     * Get the value of mediasOrdenadas
     */ 
    public function getMediasOrdenadas()
    {
        return $this->mediasOrdenadas;
    }

    /**
     * Set the value of mediasOrdenadas
     */ 
    public function setMediasOrdenadas($mediasOrdenadas)
    {
        $this->mediasOrdenadas = $mediasOrdenadas;
    }

    /**
     * Get the value of nTratamentos
     */ 
    public function getNTratamentos()
    {
        return $this->nTratamentos;
    }

    /**
     * Set the value of nTratamentos
     */ 
    public function setNTratamentos($nTratamentos)
    {
        $this->nTratamentos = $nTratamentos;
    }

    /**
     * Get the value of nClasses
     */ 
    public function getNClasses()
    {
        return $this->nClasses;
    }

    /**
     * Set the value of nClasses
     */ 
    public function setNClasses($nClasses)
    {
        $this->nClasses = $nClasses;
    }
}

?>