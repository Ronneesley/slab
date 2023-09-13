<?php
namespace QuizEstatistico\modelo\dao;

use mysqli;

/**
 * Classe abstrata de Data Access Object (DAO)
 * @author Ronneesley Moura Teles
 */
abstract class DAO {
    /**
     * Retorna as configurações atuais do banco de dados
     * @return Objeto json com as propriedades
     */
    public function getConfiguracoes(){
        return json_decode(file_get_contents("./configuracoes.json"));
    }
    
    /**
     * Realiza a conexão com o banco de dados
     * @return conexão com o banco
     */
    public function conectar() {
        $json = $this->getConfiguracoes();
            
        //Realiza a tentativa de conexão
        return $this->realizar_conexao($json->servidor, $json->usuario, 
                $json->senha, $json->banco_dados, $json->porta);
    }
    
    public function realizar_conexao($servidor, $usuario, $senha, $bancoDados, $porta) {
        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        mysqli_report(MYSQLI_REPORT_OFF);

        //Realiza a tentativa de conexão
        $con = new mysqli();
        @$con->connect($servidor, $usuario, $senha, $banco_dados, $porta);

        //Verifica se a conexão funcionou
        if ($con->connect_errno) {
            throw new \Exception("Falha na conexão com o banco de dados (" . $con->connect_errno . "): " . $con->connect_error);
        }

        //Retorna a conexão
        return $con;
    }
}

?>
