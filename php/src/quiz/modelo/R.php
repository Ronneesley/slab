<?php
namespace QuizEstatistico\modelo;

class R {
    public function criarArquivoTemporario($nome){
        $diretorioTemporario = "./tmp/";
        $path_arquivo = $diretorioTemporario . "/" . $nome;
        $arquivo = fopen($path_arquivo, "w+");
        
        $nomeArquivoGerado = $nome;
        
        return [$arquivo, $path_arquivo, $nomeArquivoGerado];
    }

    public function executarArquivoR($nome){
        $path_arquivo = "./tmp/$nome";
        exec("Rscript " . $path_arquivo, $retorno);        
        return $retorno;
    }

    /**
     * Executa o vetor de comandos C
     */
    public function processar($C){
        $dadosArquivo = $this->criarArquivoTemporario("comandos.R");
        $f = $dadosArquivo[0];
        $nomeArquivo = $dadosArquivo[2];

        for ($i = 0; $i < count($C); $i++){
            $c = $C[$i];

            fwrite($f, $c . "\n");
            fwrite($f, "print('---------------')\n");
        }

        fclose($f);

        $resultado = $this->executarArquivoR($nomeArquivo);

        return $resultado;
    }
}
?>