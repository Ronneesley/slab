<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QuizEstatistico\modelo\bo\TesteTukey;

final class TesteTukeyTest extends TestCase
{
    /**
     * Comparação de variedades de milho
     * 
     * Fonte:
     * https://www.youtube.com/watch?v=9qNXNPqKrAc
     */
    public function testExemploVariadesMilho(): void
    {
        $t = new TesteTukey();
        $delta = $t->calcularDelta(4.05, 7, 5);

        $this->assertEqualsWithDelta(2.14, $delta, 0.01);

        $medias = [31, 27, 26, 23];
        list($r, $nC) = $t->classificar($medias, 2.14);

        $this->assertEquals(3, $nC);
        $this->assertEquals(array('a'), $r[0]);
        $this->assertEquals(array('b'), $r[1]);
        $this->assertEquals(array('b'), $r[2]);
        $this->assertEquals(array('c'), $r[3]);
    }

     /**
     * Comparação de variedades de leite
     * 
     * Fonte:
     * https://www.youtube.com/watch?v=zV7ToVXQCBA 
     * 
     */
    public function testeLeite(): void
    {
        $t = new TesteTukey();
        $delta = $t->calcularDelta(4.05,0.9988,5);

        $this->assertEqualsWithDelta(1.81, $delta, 0.01);
        $medias=[22,20,19,18.5];
        list($r, $nC) = $t->classificar($medias,1.81);
        
        
        $this->assertEquals(array('a'), $r[0]);
        $this->assertEquals(array('b'), $r[1]);
        $this->assertEquals(array('b'), $r[2]);
        $this->assertEquals(array('b'), $r[3]);    
        print_r($r);
    }

    /**
     * Comparação Satisfaçaõo de posto de trabalho
     * Fonte:
     * 
     *https://www.youtube.com/watch?v=qnpP3-sP6Uc teste OK!
     * 
     * 
     */
    public function testTrabalho(): void
    {
        $t = new TesteTukey();
        $delta = $t->calcularDelta(3.51,0.64,10);

        $this->assertEqualsWithDelta(0.888, $delta, 0.01);
        $medias=[7.3,5.9,8.6];
        list($r,$nC)= $t->classificar($medias,0.888);
        
        $this->assertEquals(array('a'), $r[0]);
        $this->assertEquals(array('b'), $r[1]);
        $this->assertEquals(array('c'), $r[2]);
        print_r($r);
       
    }
}
?> 