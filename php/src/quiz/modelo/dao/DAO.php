<?php

/**
 * Description of DAO
 *
 * @author aluno
 */
abstract class DAO {
    public function conectar(){
        $con = new mysqli("localhost", "root", "if2022", "quizestatistico");
        if ($con->connect_errno) {
            echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $mysqli->connect_error;
        }
        return $con;
    }
}

?>