<?php
require __DIR__ . '/vendor/autoload.php';

use QuizEstatistico\controle\PrincipalControle;

date_default_timezone_set('America/Sao_Paulo');

$controle = new PrincipalControle();
$controle->processar( 
        isset($_REQUEST["controle"])?$_REQUEST["controle"]:"principal", 
        isset($_REQUEST["acao"])?$_REQUEST["acao"]:"");
?>