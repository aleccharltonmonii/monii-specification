<?php

namespace Monii\Specification\Tests\Fixtures;

class Pet
{
    /**
     * @var string
     */
    private $animal;

    /**
     * @var int
     */
    private $numberOfLegs;

    /**
     * @param string $animal
     * @param int $numberOfLegs
     */
    public function __construct($animal, $numberOfLegs)
    {
        $this->animal = $animal;
        $this->numberOfLegs = $numberOfLegs;
    }

    /**
     * @return string
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @return int
     */
    public function getNumberOfLegs()
    {
        return $this->numberOfLegs;
    }
}
