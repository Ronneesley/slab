<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QuizEstatistico\modelo\Estatistica;
use QuizEstatistico\modelo\TesteF;

final class TesteFTest extends TestCase
{
    public function testExemplo1(): void
    {
        $A = [48, 48, 49, 50, 52, 54, 58];
        $B = [37, 42, 43, 46, 47, 48];

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