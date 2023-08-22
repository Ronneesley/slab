<html>
    <head>
        <title>DIC - Dados</title>

        <meta charset="utf-8" />
    </head>
    <body>
        <?php
            $I = $_GET["n_tratamentos"];
            $J = $_GET["n_repeticoes"];
        ?>

        <form method="post" action="dic.php">
            <input type="hidden" name="n_repeticoes" value="<?=$J?>" />

            <table border="1">
                <thead>
                    <tr>
                        <th rowspan="2">Tratamentos</th>
                        <th colspan="<?=$J?>">Repetições</th>
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
                            <td><input type="text" name="tratamentos[]" /></td>

                            <?php
                                for ($j = 0; $j < $J; $j++){
                            ?>
                                <td>
                                    <input type="text" name="leituras[<?=$i?>][<?=$j?>]" style="width: 70px;" />
                                </td>
                            <?php
                                }
                            ?>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>

            <br />
            <input type="submit" value="Calcular ANOVA" />
        </form>
    </body>
</html>