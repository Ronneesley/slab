<?php
require __DIR__ . '/vendor/autoload.php';

use QuizEstatistico\controle\Roteador;

date_default_timezone_set('America/Sao_Paulo');

$roteador = new Roteador();
$roteador->processarControles( 
        isset($_REQUEST["controle"])?$_REQUEST["controle"]:"principal", 
        isset($_REQUEST["acao"])?$_REQUEST["acao"]:"");
?>