<?php

namespace FizzBuzz;

class FizzBuzzGameRule
{
    /** @var  string */
    public $name;
    /** @var callable */
    private $behaviour;

    /**
     * FizzBuzzGameRule constructor.
     *
     * @param $name
     * @param $behaviour
     */
    public function __construct($name, $behaviour)
    {
        $this->name = $name;
        $this->behaviour = $behaviour;
    }

    public function applyRule($game)
    {
        return $this->ruleApplies($game) ? $this->name : '';
    }

    private function ruleApplies($game)
    {
        $cb = $this->behaviour;

        return $cb($game);
    }

}
