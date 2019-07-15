<?php


use bigpaulie\behat\Calculator;
use bigpaulie\behat\Exceptions\DivisionByZeroException;
use PHPUnit\Framework\TestCase;

/**
 * Class CalculatorMockTest
 * @package bigpaulie\behat\test
 */
class CalculatorMockTest extends TestCase
{
    /**
     * @var Calculator|Mockery\MockInterface
     */
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = Mockery::mock(Calculator::class);
    }

    public function testAdditionShouldPass()
    {
        $this->calculator->shouldReceive('add')->once()->andReturns(2);
        $add = $this->calculator->add(1,1);
        $this->assertIsNumeric($add);
        $this->assertEquals(2, $add);
    }

    public function testDivideShouldFail(){
        $this->expectException(DivisionByZeroException::class);
        $this->calculator->shouldReceive('divide')->once()->andThrow(DivisionByZeroException::class);
        $divide = $this->calculator->divide(1, 0);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}