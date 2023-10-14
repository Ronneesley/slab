<?php
namespace QuizEstatistico\util;

/**
 * Esta classe guarda informações adicionais do rank
 * @author Thiago
 */
class GuardaRank {

    private $md;

    
    public function __construct() {
        
    }

    public function getMd() {
        return $this->md;
    }

    public function setMd($md): void {
        $this->md = $md;
    }
}

?>