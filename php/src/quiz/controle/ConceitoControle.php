<?php
namespace QuizEstatistico\controle;

class ConceitoControle extends ControleBase {
    public function processar($acao){
        switch ($acao){
            case "exibir":
                $this->exibir();
                break;
        }
    }
    
    public function exibir(){
        $conceito = $_REQUEST["conceito"];
        
        $paginas = array('amostra_populacao.html', 'boxplot_pictograma.html', 
            'distribuicao.html', 'estatistica_descritiva.html', 'estrutura_conteudo_padrao.html', 
            'grafico.html', 'grafico_quantitativa_continua.html', 'grafico_quantitativa_discreta.html', 
            'graficos_variaveis_qualitativas.html', 'indice.html', 'medidas_tendencia_central.html', 
            'medidas_dispersao.html', 'medidas_separatrizes.html', 'conceitos_estatisticos.html', 'tabelas.html', 
            'variaveis.html');
        
        if (in_array($conceito . ".html", $paginas)) {
            $layout = $this->configurarTemplate("layout.html");
            $this->mostrarPaginaLayout($layout, "conceitos/" . $conceito . ".html");
        }
    }
}
?>