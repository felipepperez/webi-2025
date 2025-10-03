<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Calculator;

class CalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAdd(): void
    {
        $resultado = $this->calculator->add(2,3);
        $this->assertEquals(5, $resultado);

        $resultado = $this->calculator->add(6,4);
        $this->assertEquals(10, $resultado);
    }

    public function testDivide(): void
    {
        $resultado = $this->calculator->divide(10,2);
        $this->assertEquals(5, $resultado);

        $resultado = $this->calculator->divide(20,2);
        $this->assertEquals(10, $resultado);
    }

    public function testDivideByZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Divisão por zero não é permitida");
        $this->calculator->divide(10,0);
    }
    
     public function testSubtract()
    {
        $result = $this->calculator->subtract(10, 4);
        $this->assertEquals(6, $result);
    }

    public function testMultiply()
    {
        $result = $this->calculator->multiply(3, 4);
        $this->assertEquals(12, $result);
    }

    public function testIsEven()
    {
        $this->assertTrue($this->calculator->isEven(4));
        $this->assertFalse($this->calculator->isEven(3));
    }

     public function testGetArraySum()
    {
        $numbers = [1, 2, 3, 4, 5];
        $result = $this->calculator->getArraySum($numbers);
        $this->assertEquals(15, $result);
    }

    public function testMultipleAssertions()
    {
        $this->assertEquals(4, $this->calculator->add(2, 2));
        $this->assertEquals(0, $this->calculator->subtract(5, 5));
        $this->assertNotEquals(10, $this->calculator->multiply(2, 3));
    }

}