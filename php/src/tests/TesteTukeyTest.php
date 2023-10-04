<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QuizEstatistico\modelo\TesteTukey;

final class TesteTukeyTest extends TestCase
{
    //https://www.youtube.com/watch?v=9qNXNPqKrAc
    public function testExemploVideo(): void
    {
        $t = new TesteTukey();
        $delta = $t->calcularDelta(4.05, 7, 5);

        $this->assertEqualsWithDelta(2.14, $delta, 0.01);

        $r = $t->classificar([23, 27, 26, 31], 2.14);
        
        /*$this->assertEquals(array('c'), $r[0]);
        $this->assertEquals(array('b'), $r[1]);
        $this->assertEquals(array('b'), $r[2]);
        $this->assertEquals(array('a'), $r[3]);*/

        //print_r($r);

        $this->assertEquals(array('a'), $r[0]);
        $this->assertEquals(array('b'), $r[1]);
        $this->assertEquals(array('b'), $r[2]);
        $this->assertEquals(array('c'), $r[3]);
    }
}
?>