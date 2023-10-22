<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QuizEstatistico\modelo\bo\Estatistica;
use QuizEstatistico\modelo\bo\TesteF;

final class TesteFTest extends TestCase
{
    public function testExemplo1(): void
    {
        $A = [];
        $B = [];

        $estatistico = new Estatistica();
        $mediaA = $estatistico->calcularMedia($A);
        $varianciaA = $estatistico->calcularVariancia($A);

        $this->assertEqualsWithDelta(51.28, $mediaA, 0.01);
        $this->assertEqualsWithDelta(13.57, $varianciaA, 0.01);

        $mediaB = $estatistico->calcularMedia($B);
        $varianciaB = $estatistico->calcularVariancia($B);

        $this->assertEqualsWithDelta(43.83, $mediaB, 0.01);
        $this->assertEqualsWithDelta(16.56, $varianciaB, 0.01);

        $testeF = new TesteF();
        $fCalculado = $testeF->calcular($B, $A);

        $this->assertEqualsWithDelta(1.22, $fCalculado, 0.01);




               
    }
}
?>