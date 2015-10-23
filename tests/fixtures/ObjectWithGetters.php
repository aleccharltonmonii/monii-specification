<?php

namespace Monii\Specification\Tests\Fixtures;

class ObjectWithGetters
{
    private $one;
    private $two;
    private $three;

    public function __construct()
    {
    }

    public function getOne()
    {
        return $this->one;
    }

    public function withOne($one)
    {
        $instance = clone($this);
        $instance->one = $one;

        return $instance;
    }

    protected function getTwo()
    {
        return $this->two;
    }

    public function withTwo($two)
    {
        $instance = clone($this);
        $instance->two = $two;

        return $instance;
    }

    private function getThree()
    {
        return $this->three;
    }

    public function withThree($three)
    {
        $instance = clone($this);
        $instance->three = $three;

        return $instance;
    }

    public static function create()
    {
        return new self();
    }
}
