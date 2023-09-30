<?php

namespace Skyfall\Phpunit;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase {
    public function testSoma() {
        $resultado = 2 + 2;
        $this->assertEquals(4, $resultado);
    }
}
/*
Para testar 
vendor/bin/phpunit tests/MathTest.php
*/

?>