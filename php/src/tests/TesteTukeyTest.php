<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QuizEstatistico\modelo\TesteTukey;

final class TesteTukeyTest extends TestCase
{
    //https://www.youtube.com/watch?v=9qNXNPqKrAc
    //https://www.youtube.com/watch?v=zV7ToVXQCBA teste OK!
    //https://www.youtube.com/watch?v=qnpP3-sP6Uc teste OK! ULTIMO TESTE
    public function testExemploVideo(): void
    {
        $t = new TesteTukey();
        $delta = $t->calcularDelta(3.51,0.64,10);

        $this->assertEqualsWithDelta(0.888, $delta, 0.01);

        $r = $t->classificar([22,19,18.5,20],0.888);
        
        /*$this->assertEquals(array('c'), $r[0]);
        $this->assertEquals(array('b'), $r[1]);
        $this->assertEquals(array('b'), $r[2]);
        $this->assertEquals(array('a'), $r[3]);*/

        
        $this->assertEquals(array('a'), $r[0]);
        $this->assertEquals(array('b'), $r[1]);
        $this->assertEquals(array('c'), $r[2]);
        //$this->assertEquals(array('b'), $r[3]);        
        print_r($r);
    }
}
?>