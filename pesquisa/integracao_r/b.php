<html>
  <head>
    <title>Amostra de integração PHP e R</title>
  </head>
  <body>
    <div>
    <?php
      // Executa o script R dentro do código PHP
      // Gera saída como imagem test.png.
      exec("amostra.R");    ?>
    <img src="test.png" alt="R Graph" />
    </div>
  </body>
</html>
