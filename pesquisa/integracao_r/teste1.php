<?php 
$arquivo = fopen('meuarquivo.R','w');
 if ($arquivo == false) die('Não foi possível criar o arquivo.'); 
  $a = 25;
fwrite($arquivo, '3+'. $a ); 
 fclose($arquivo);
exec('meuarquivo.R', $retorno);
  
 $last_line = ltrim($retorno[0], '[1]');


 echo 'Última linha da saída: '.$last_line;

 ?>

 
