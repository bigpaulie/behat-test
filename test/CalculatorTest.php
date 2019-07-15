<?php

namespace bigpaulie\behat\test;

use bigpaulie\behat\Exceptions\DivisionByZeroException;
use PHPUnit\Framework\TestCase;
use bigpaulie\behat\Calculator;

/**
 * Class CalculatorTest
 * @package bigpaulie\behat\test
 */
class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * Setup dependencies and mock-ups
     */
    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAdditionShouldPass()
    {
        $this->assertInstanceOf(Calculator::class, $this->calculator);
        /** @var int $addition */
        $addition = $this->calculator->add(1, 1);
        $this->assertIsNumeric($addition);
        $this->assertEquals($addition, 2);
    }

    public function testSubstationShouldPass()
    {
        /** @var int $substraction */
        $substraction = $this->calculator->substract(2, 1);
        $this->assertIsNumeric($substraction);
        $this->assertEquals($substraction, 1);
    }

    public function testMultiplicationShouldPass()
    {
        /** @var int $multiplication */
        $multiplication = $this->calculator->multiply(2, 2);
        $this->assertIsNumeric($multiplication);
        $this->assertEquals($multiplication, 4);
    }

    public function testDivisionShouldPass()
    {
        /** @var int $division */
        $division = $this->calculator->divide(2, 2);
        $this->assertIsNumeric($division);
        $this->assertEquals($division, 1);
    }

    public function testDivisionShouldFailDivisionByZero()
    {
        $this->expectException(DivisionByZeroException::class);
        /** @var int $division */
        $division = $this->calculator->divide(2, 0);
    }
}