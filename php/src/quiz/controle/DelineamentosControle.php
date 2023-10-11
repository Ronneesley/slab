<?php

namespace QuizEstatistico\controle;

abstract class DelineamentosControle extends ControleBase {
    function formatarLeituras($leiturasString){
        $leituras = array();
        for ($i = 0; $i < count($leiturasString); $i++){
            $ts = array();
            
            for ($j = 0; $j < count($leiturasString[$i]); $j++){                
                $valorConvertido = $this->converterNumero($leiturasString[$i][$j]);
                
                array_push($ts, $valorConvertido);
            }
            
            array_push($leituras, $ts);
        }

        return $leituras;
    }
}

?>