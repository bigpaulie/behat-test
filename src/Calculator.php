<?php


namespace bigpaulie\behat;

use bigpaulie\behat\Exceptions\DivisionByZeroException;

/**
 * Class Calculator
 * @package bigpaulie\behat
 */
class Calculator
{
    /**
     * @param int $number1
     * @param int $number2
     * @return int
     */
    public function add(int $number1, int $number2):int
    {
        return $number1 + $number2;
    }

    /**
     * @param int $number1
     * @param int $number2
     * @return int
     */
    public function substract(int $number1, int $number2):int
    {
        return $number1 - $number2;
    }

    /**
     * @param int $number1
     * @param int $number2
     * @return int
     */
    public function multiply(int $number1, int $number2):int
    {
        return $number1 * $number2;
    }

    /**
     * @param int $number1
     * @param int $number2
     * @return int
     * @throws DivisionByZeroException
     */
    public function divide(int $number1, int $number2):int
    {
        try {
            return $number1 / $number2;
        } catch (\Throwable $error) {
            throw new DivisionByZeroException($error->getMessage(), $error->getCode());
        }
    }
}