<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QuizEstatistico\modelo\bo\DIC;

final class DICTest extends TestCase
{
    //https://www.fcav.unesp.br/Home/departamentos/cienciasexatas/AMANDALIZPACIFICOMANFRIM/aula-8.pdf
    public function testExperimentoMandioca(): void
    {
        $tratamentos = ["IAC 5", "IAC 7", "IAC 11", "IRACEMA", "MANTIQUEIRA"];
        $leituras = [
            [ 38.9, 25.4, 20.3, 25.7, 29.3 ],
            [
                20.9,
                26.2,
                32.3,
                28.3,
                28.7
            ],
            [
                28.1,
                27,
                25.8,
                26.9,
                22.3
            ],
            [
                38.7,
                43.2,
                41.7,
                39,
                40.3
            ],
            [
                47.8,
                47.8,
                44.7,
                50.5,
                56.4
            ]
        ];
        $J = 5;

        $dic = new DIC();
        $dic->calcular($tratamentos, $leituras, $J);

        $this->assertEqualsWithDelta(139.6, $dic->getL()[0], 0.01);
        $this->assertEqualsWithDelta(136.4, $dic->getL()[1], 0.01);
        $this->assertEqualsWithDelta(130.1, $dic->getL()[2], 0.01);
        $this->assertEqualsWithDelta(202.9, $dic->getL()[3], 0.01);
        $this->assertEqualsWithDelta(247.2, $dic->getL()[4], 0.01);

        $this->assertEqualsWithDelta(856.2, $dic->getG(), 0.01);

        //GLTRAT
        $this->assertEqualsWithDelta(4, $dic->getGLTrat(), 0.01);

        //GLRES
        $this->assertEqualsWithDelta(20, $dic->getGLRes(), 0.01);

        //GLTOTAL
        $this->assertEqualsWithDelta(24, $dic->getGLTotal(), 0.01);

        //SQTRAT    
        $this->assertEqualsWithDelta(2135.94, $dic->getSQTrat(), 0.01);

        //SQRES
        $this->assertEqualsWithDelta(373.52, $dic->getSQRes(), 0.01);

        //SQTOTAL
        $this->assertEqualsWithDelta(2509.46, $dic->getSQTotal(), 0.01);

        //QMTRAT
        $this->assertEqualsWithDelta(533.99, $dic->getQMTrat(), 0.01);

        //QMRES
        $this->assertEqualsWithDelta(18.68, $dic->getQMRes(), 0.01);

        //FCalculado
        $this->assertEqualsWithDelta(28.586, $dic->getFCalc(), 0.01);

    }

    //https://arsilva.weebly.com/uploads/2/1/0/0/21008856/aula_dic_dbc.pdf
    //EXEMPLO 2
    public function testExperimentoPulgaoPepino(): void{
        $tratamentos =  ["A", "B", "C", "D", "E"];
        $leituras = [
            [
                2370,
                1687,
                2592,
                2283,
                2910,
                3020
            ],
            [
                1282,
                1527,
                871,
                1025,
                825,
                920
            ],
            [
                562,
                321,
                636,
                317,
                485,
                842
            ],
            [
                173,
                127,
                132,
                150,
                129,
                227
            ],
            [
                193,
                71,
                82,
                62,
                96,
                44
            ]
        ];

        $J = 5;

        $dic = new DIC();
        $dic->calcular($tratamentos, $leituras, $J);

        $this->assertEqualsWithDelta(14.862, $dic->getL()[0], 0.01);
        $this->assertEqualsWithDelta(6.450, $dic->getL()[1], 0.01);
        $this->assertEqualsWithDelta(3.163, $dic->getL()[2], 0.01);
        $this->assertEqualsWithDelta(938, $dic->getL()[3], 0.01);
        $this->assertEqualsWithDelta(548, $dic->getL()[4], 0.01);

        //TOTAL
        $this->assertEqualsWithDelta(25.961, $dic->getG(), 0.01);

        //GLTRAT
        $this->assertEqualsWithDelta(4, $dic->getGLTrat(), 0.01);

        //GLRES
        $this->assertEqualsWithDelta(25, $dic->getGLRes(), 0.01);

        //GLTOTAL
        $this->assertEqualsWithDelta(29, $dic->getGLTotal(), 0.01);

        //SQTRAT    
        $this->assertEqualsWithDelta(23.145259467, $dic->getSQTrat(), 0.01);

        //SQRES
        $this->assertEqualsWithDelta(1.768643500, $dic->getSQRes(), 0.01);

        //SQTOTAL
        $this->assertEqualsWithDelta(24.913902967, $dic->getSQTotal(), 0.01);

        //QMTRAT
        $this->assertEqualsWithDelta(5.786314867, $dic->getQMTrat(), 0.01);

        //QMRES
        $this->assertEqualsWithDelta(70.745740, $dic->getQMRes(), 0.01);

        //FTAB
        $this->assertEqualsWithDelta(81.790, $dic->getFTab(), 0.01);
    }

    //https://www.fcav.unesp.br/Home/departamentos/cienciasexatas/EUCLIDESBRAGAMALHEIROS/materialdidatico/anoletivo-2014/ApostilaEEAR_Cap3atm.pdf
    public function testExperimentoEfeitoRacaoPesoAnimal(): void{
        $tratamentos = ["1", "2", "3", "4", "5"];
        $leituras = [
            [
                3.31,
                6.1,
                8.53,
                3.84
            ],
            [
                23.62,
                26.94,
                20.16,
                22.18
            ],
            [
                14.75,
                25.2,
                17.56,
                24.8
            ],
            [
                30.58,
                30.69,
                18.54,
                27.56
            ],
            [
                50.25,
                45.12,
                37.25,
                52.15
            ]
        ];

        $J = 5;

        $dic = new DIC();
        $dic->calcular($tratamentos, $leituras, $J);

        $this->assertEqualsWithDelta(21.78, $dic->getL()[0], 0.01);
        $this->assertEqualsWithDelta(92.90, $dic->getL()[1], 0.01);
        $this->assertEqualsWithDelta(82.31, $dic->getL()[2], 0.01);
        $this->assertEqualsWithDelta(107.37, $dic->getL()[3], 0.01);
        $this->assertEqualsWithDelta(184.77, $dic->getL()[4], 0.01);

        //TOTAL
        $this->assertEqualsWithDelta(489.13, $dic->getG(), 0.01);

        //GLTRAT
        $this->assertEqualsWithDelta(4, $dic->getGLTrat(), 0.01);

        //GLRES
        $this->assertEqualsWithDelta(15, $dic->getGLRes(), 0.01);

        //GLTOTAL
        $this->assertEqualsWithDelta(19, $dic->getGLTotal(), 0.01);

        //SQTRAT    
        $this->assertEqualsWithDelta(3.424588, $dic->getSQTrat(), 0.01);

        //SQRES
        $this->assertEqualsWithDelta(355.078, $dic->getSQRes(), 0.01);

        //SQTOTAL
        $this->assertEqualsWithDelta(3.779666, $dic->getSQTotal(), 0.01);

        //QMTRAT
        $this->assertEqualsWithDelta(856.147, $dic->getQMTrat(), 0.01);

        //QMRES
        $this->assertEqualsWithDelta(23.672, $dic->getQMRes(), 0.01);

        //FTAB
        $this->assertEqualsWithDelta(36.167, $dic->getFTab(), 0.01);
    }

}
?>