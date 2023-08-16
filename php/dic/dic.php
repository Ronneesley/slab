<pre>
<?php

    /*print_r($_REQUEST["tratamentos"]);

    print_r($_REQUEST["leituras"]);*/

?>
</pre>

<?php
    function converterNumero($numero_em_string){
        return floatval(strtr($numero_em_string, ",", "."));
    }

    function formatarNumero($numero, $digitos = 2){
        return strtr( number_format($numero, $digitos) , ".", ",");
    }

    $tratamentos = $_REQUEST["tratamentos"];
    $leituras = $_REQUEST["leituras"];

    $I = count($tratamentos);
    $J = $_REQUEST["n_repeticoes"];

    $L = array();
    for ($i = 0; $i < $I; $i++){
        $S = 0;
        for ($j = 0; $j < $J; $j++){
            $S += converterNumero($leituras[$i][$j]);
        }

        $L[$i] = $S;
    }

    $G = 0;
    for ($i = 0; $i < $I; $i++){
        $G += $L[$i];
    }

    //Calculando o valor C
    $C = $G ** 2 / ($I * $J);

    //Calculando SQTotal
    $S = 0;
    for ($i = 0; $i < $I; $i++){
        for ($j = 0; $j < $J; $j++){
            $S += converterNumero($leituras[$i][$j]) ** 2;
        }
    }

    $SQTotal = $S - $C;

    //Calculando SQTrat
    $S = 0;
    for ($i = 0; $i < $I; $i++){
        $S += $L[$i] ** 2;
    }

    $SQTrat = $S / $J - $C;

    //Calculando SQRes
    $SQRes = $SQTotal - $SQTrat;

    $GLTrat = $I - 1;
    $GLRes = $I * ($J - 1);

    $GLTotal = $I * $J - 1;

    $QMTrat = $SQTrat / $GLTrat;
    $QMRes = $SQRes / $GLRes;

    $FCalc = $QMTrat / $QMRes;
?>

<table border="1">
    <thead>
        <tr>
            <th rowspan="2">Tratamentos</th>
            <th colspan="<?=$J?>">Repetições</th>
            <th rowspan="2">Total</th>
        </tr>

        <tr>
            <?php
                for ($j = 0; $j < $J; $j++){
            ?>
                <th><?=$j + 1?></th>
            <?php
                }
            ?>
        </tr>
    </thead>

    <tbody>
        <?php
            for ($i = 0; $i < $I; $i++){
        ?>
            <tr>
                <td><?=$tratamentos[$i]?></td>

                <?php
                    for ($j = 0; $j < $J; $j++){
                ?>
                    <td style="text-align: right;">
                        <?=$leituras[$i][$j]?>
                    </td>
                <?php
                    }
                ?>

                <td style="text-align: right;">
                    <?=formatarNumero($L[$i])?>
                </td>
            </tr>            
        <?php
            }
        ?>
    </tbody>

    <tfoot>
        <tr>
            <th colspan="<?=$J + 1?>">TOTAL</th>
            <th><?=formatarNumero($G)?></th>
        </tr>
    </tfoot>
</table>

<h2>ANOVA</h2>

<table border="1">
    <thead>
        <tr>
            <th>Causa de Variação</th>
            <th title="Grau de Liberdade">GL</th>
            <th>SQ</th>
            <th>QM</th>
            <th>F</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Tratamento</td>
            <td style="text-align: right;"><?=$GLTrat?></td>
            <td style="text-align: right;"><?=formatarNumero($SQTrat)?></td>
            <td style="text-align: right;"><?=formatarNumero($QMTrat)?></td>
            <td style="text-align: right;"><?=formatarNumero($FCalc)?></td>
        </tr>

        <tr>
            <td>Resíduo</td>
            <td style="text-align: right;"><?=$GLRes?></td>
            <td style="text-align: right;"><?=formatarNumero($SQRes)?></td>
            <td style="text-align: right;"><?=formatarNumero($QMRes)?></td>
        </tr>

        <tr>
            <td>Total</td>
            <td style="text-align: right;"><?=$GLTotal?></td>
            <td style="text-align: right;"><?=formatarNumero($SQTotal)?></td>
        </tr>
    </tbody>
</table>

<h2>Conclusão</h2>

<?php
    $alfa = 0.05; //Nível de significância

    $FTab = 2.87; //Trabalho a ser feito

    if ($FCalc < $FTab){
        echo "O teste é <strong>não significativo</strong> ao nível de significância de $alfa. Aceitamos H0.";
    } else {
        echo "O teste é <strong>significativo</strong> ao nível de significância de $alfa. Rejeita H0 em Favor de H1.";
    }

?>