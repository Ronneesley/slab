<?php
namespace QuizEstatistico\modelo;

/**
 * Classe responsável pelo cálculo teste de Tukey
 * @author Ronneesley Moura Teles
 */
class TesteTukey {
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