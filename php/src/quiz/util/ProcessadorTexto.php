<?php

class ProcessadorTexto {    
	
    public function processar_marcacoes_de_imagens($string) {
    	
		$string2 = str_replace("[img id=\"", "<img src=\"miniatura.php?id=", $string);
		$string3 = str_replace("\" largura=\"","&largura=", $string2);
		$string4 = str_replace("\" altura=\"","&altura=", $string3);
		$string_final =  str_replace("]"," />", $string4);
		
		return $string_final;
	}
    
}

?>