<?php
namespace QuizEstatistico\modelo\dao;

use mysqli;

/**
 * Description of DAO
 *
 * @author Ronne
 */
abstract class DAO {
    public function conectar(){
        $con = new mysqli("localhost", "quiz", "quiz123", "quizestatistico");
        if ($con->connect_errno) {
            echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $mysqli->connect_error;
        }
        return $con;
    }
}

?>
