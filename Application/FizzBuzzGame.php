<?php

namespace FizzBuzz;

class FizzBuzzGame
{

    /** @var int */
    public $number;
    /** @var FizzBuzzGameRule[] */
    private $rules;

    /**
     * FizzBuzzGame constructor.
     *
     * @param int                $number
     * @param FizzBuzzGameRule[] $rules
     */
    public function __construct($number, $rules)
    {
        $this->number = $number;
        $this->rules = $rules;
    }

    function play()
    {
        $_ret = '';

        foreach ($this->rules as $rule) {
            $_ret .= $rule->applyRule($this);
        }
        if (empty($_ret)) {
            $_ret = $this->number;
        }

        return $_ret;
    }

}
