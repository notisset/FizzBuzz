<?php

namespace FizzBuzz\Tests;

use FizzBuzz\FizzBuzzGame;
use FizzBuzz\FizzBuzzGameRule;

class FizzBuzzGameTest extends \PHPUnit\Framework\TestCase
{
    /** @var  \FizzBuzz\FizzBuzzGameRule */
    private $fizzRule;
    /** @var  \FizzBuzz\FizzBuzzGameRule */
    private $buzzRule;
    /** @var  \FizzBuzz\FizzBuzzGameRule */
    private $fizzPlusRule;
    /** @var  \FizzBuzz\FizzBuzzGameRule */
    private $buzzPlusRule;

    public function setUp()
    {
        $this->fizzRule = new FizzBuzzGameRule(
            'Fizz', function (FizzBuzzGame $game) {
            return $game->number % 3 == 0;
        }
        );
        $this->buzzRule = new FizzBuzzGameRule(
            'Buzz', function (FizzBuzzGame $game) {
            return $game->number % 5 == 0;
        }
        );
        $this->fizzPlusRule = new FizzBuzzGameRule(
            'Fizz', function (FizzBuzzGame $game) {
            return $game->number % 3 == 0
                || strpos((string)$game->number, '3') !== false;
        }
        );
        $this->buzzPlusRule = new FizzBuzzGameRule(
            'Buzz', function (FizzBuzzGame $game) {
            return $game->number % 5 == 0
                || strpos((string)$game->number, '5') !== false;
        }
        );
    }

    public function testFizzBuzzGameRule()
    {
        $this->assertEquals(
            $this->fizzRule->applyRule(new FizzBuzzGame(3, [])), 'Fizz'
        );
        $this->assertNotEquals(
            $this->fizzRule->applyRule(new FizzBuzzGame(17, [])), 'Fizz'
        );

    }

    public function testFizzBuzzGame()
    {
        $expectedValues = [
            1  => 1,
            3  => "Fizz",
            5  => "Buzz",
            15 => "FizzBuzz",
        ];

        $rules = [
            $this->fizzRule,
            $this->buzzRule,
        ];

        foreach ($expectedValues as $number => $expectedValue) {
            $game = new FizzBuzzGame($number, $rules);
            $this->assertEquals($expectedValue, $game->play());
        }
    }

    public function testFizzBuzzPlusGame()
    {
        $expectedValues = [
            1  => 1,
            3  => "Fizz",
            5  => "Buzz",
            15 => "FizzBuzz",
            31 => "Fizz",
            51 => "Buzz",
        ];

        $rules = [
            $this->fizzPlusRule,
            $this->buzzPlusRule,
        ];

        foreach ($expectedValues as $number => $expectedValue) {
            $game = new FizzBuzzGame($number, $rules);
            $play =  $game->play();
            $this->assertNotFalse(
                $play === $expectedValue ||
                strpos($play, $expectedValue),
                "Failed asserting that {$expectedValue} not in {$play}");
        }
    }

}

