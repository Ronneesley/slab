<?php
namespace QuizEstatistico\modelo\dao;

//use mysqli;
use pdo;
use PDOException;

/**
 * Classe abstrata de Data Access Object (DAO)
 * @author Ronneesley Moura Teles
 */
abstract class DAO {
    /**
     * Variável que armazena a conexão
     */
    private static $con = null;

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
        if (DAO::$con == null){
            $json = $this->getConfiguracoes();
                
            //Realiza a tentativa de conexão
            DAO::$con = $this->realizar_conexao($json->servidor, $json->usuario, 
                $json->senha, $json->banco_dados, $json->porta);
        }

        return DAO::$con;
    }
    
    public function realizar_conexao($servidor, $usuario, $senha, $bancoDados, $porta) {
        try {
            $con = new PDO("mysql:dbname=$bancoDados;host=$servidor", $usuario, $senha);
        } catch (PDOException $e){
            throw new \Exception("Falha na conexão com o banco de dados: " . $e->getMessage());
        }

        //Retorna a conexão
        return $con;
    }
}

?>
