<?php

namespace QuizEstatistico\modelo\bo;

class AmplitudeTotal {
    public function studentizadaQ(){
        $m = [];
        
        //Primeira linha
        $m[0] = [''];
        for ($j = 2; $j <= 20; $j++){
            array_push($m[0], $j);
        }

        //Demais linhas
        for ($i = 1; $i <= 20; $i++){
            $this->adicionarLinha($m, $i);
        }

        $this->adicionarLinha($m, 24);
        $this->adicionarLinha($m, 30);
        $this->adicionarLinha($m, 40);
        $this->adicionarLinha($m, 60);
        $this->adicionarLinha($m, 120);

        return $m;
    }

    private function adicionarLinha(& $m, $valor){
        $n = count($m);

        array_push($m, [$valor]);
        for ($j = 2; $j <= 20; $j++){
            array_push($m[$n], $this->calcularStudentizadaQ($valor, $j));
        }
    }

    /**
     * Fontes:
     * Distribuição: https://en.wikipedia.org/wiki/Studentized_range_distribution
     * Função gama: https://pt.wikipedia.org/wiki/Função_gama
     */
    public function calcularStudentizadaQ($n1, $n2){
        return 0;
    }

    /**
     * Fontes:
     * https://pt.wikipedia.org/wiki/Função_gama
     */
    public function calcularGama($t, $limite = 1000, $delta = 0.00004){
        $area = 0;

        for ($x = 0; $x < $limite; $x += $delta){
            $area += $this->funcaoInternaGama($x, $t) * $delta;
        }

        return $area;
    }

    private function funcaoInternaGama($x, $t){
        return $x ** ($t - 1) * exp(-$x);
    }
}

?>