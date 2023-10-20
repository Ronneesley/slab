<?php
namespace QuizEstatistico\controle;

use QuizEstatistico\modelo\dto\Questao;
use QuizEstatistico\modelo\dao\QuestaoDAO;
use QuizEstatistico\modelo\dao\NivelDAO;
use QuizEstatistico\modelo\dao\CursoDAO;
use QuizEstatistico\modelo\dao\TemaDAO;
use QuizEstatistico\controle\PrincipalControle;

/**
 * Description of QuestãoControle
 *
 * @author Wagner e Mayko
 */
class QuestaoControle extends ControleBase {
    public function processar($acao){
        if ($this->estaLogado()){
            switch ($acao){
                case "novo":
                    $this->mostrarFormularioCadastro();
                    break;
                case "salvar":
                    $this->salvar();
                    break;
                case "inserir":
                    $this->inserir();
                    break;
                case "alterar":
                    $this->alterar();
                    break;
                case "listar":
                    $this->listar();
                    break;
                case "excluir":
                    $this->excluir();
                    break;
                case "selecionar":
                    $this->selecionar();
                    break;
            }
        }else{
            $p = new PrincipalControle();
            $p->mostrarPaginaLogin("Faça login primeiro!");
        }
    }
    
    public function salvar(){
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != ""){
            $this->alterar();
        } else {
            $this->inserir();
        }
    }
    
    public function mostrarFormularioCadastro($questao = null, $mensagem = "",$tipo_mensagem = "success", $parametros = array()){
        $nivelDao = new NivelDAO();
        $cursoDao = new CursoDAO();
        $temaDao = new TemaDAO();
        
        $niveis = $nivelDao->listar();
        $cursos = $cursoDao->listar();
        $temas = $temaDao->listar();
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, "admin/questoes/cadastro.html",
            [   "questao" => $questao, "mensagem" => $mensagem,
                "niveis"=>$niveis, "cursos"=>$cursos, "temas"=>$temas,
                "tipo_mensagem" => $tipo_mensagem ]);
    }

    public function inserir(){
        $c = new Questao();
        $c->setNivel($_REQUEST["nivel"]);
        $c->setCurso($_REQUEST["curso"]);
        $c->setTema($_REQUEST["tema"]);
        $c->setPergunta($_REQUEST["pergunta"]);
        $c->setRespostaCerta($_REQUEST["resposta_certa"]);
        $c->setRespostaErrada1($_REQUEST["resposta_errada1"]);
        $c->setRespostaErrada2($_REQUEST["resposta_errada2"]);
        $c->setRespostaErrada3($_REQUEST["resposta_errada3"]);
        $c->setExplicacao($_REQUEST["explicacao"]);


        $dao = new QuestaoDAO();
        $dao->inserir($c);
        
        $this->mostrarFormularioCadastro($c, "Inserido com sucesso");
    }
    
    public function alterar(){
        $c = new Questao();
        $c->setId($_REQUEST["id"]);
        $c->setNivel($_REQUEST["nivel"]);
        $c->setCurso($_REQUEST["curso"]);
        $c->setTema($_REQUEST["tema"]);
        $c->setPergunta($_REQUEST["pergunta"]);
        $c->setRespostaCerta($_REQUEST["resposta_certa"]);
        $c->setRespostaErrada1($_REQUEST["resposta_errada1"]);
        $c->setRespostaErrada2($_REQUEST["resposta_errada2"]);
        $c->setRespostaErrada3($_REQUEST["resposta_errada3"]);
        $c->setExplicacao($_REQUEST["explicacao"]);

        $dao = new QuestaoDAO();
        $dao->alterar($c);
        
        $this->mostrarFormularioCadastro($c, "Alterado com sucesso");
    }
    
    public function excluir(){
        $dao = new QuestaoDAO();
        $dao->excluir($_REQUEST["id"]);
        
        $this->listar("Excluído com sucesso");
    }
    
    public function listar($mensagem = "", $tipo_mensagem = "success"){
        $dao = new QuestaoDAO();
        $lista = $dao->listar();
        
        $layout = $this->configurarTemplate("admin/layout.html");
        $this->mostrarPaginaLayout($layout, 
        "admin/questoes/listagem.html", 
        ["mensagem" => $mensagem, 
        "lista" => $lista,
        "tipo_mensagem" => $tipo_mensagem ]);
    }
    
    public function selecionar(){
        $dao = new QuestaoDAO();
        $c = $dao->selecionar($_REQUEST["id"]);
        
        $this->mostrarFormularioCadastro($c, "Selecionado com sucesso");
    }
}
?>