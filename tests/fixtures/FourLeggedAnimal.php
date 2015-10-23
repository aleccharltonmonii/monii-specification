<?php

namespace Monii\Specification\Tests\Fixtures;

use Monii\Specification\DelagatingSpecification;
use Monii\Specification\Operator\Equals;
use Monii\Specification\Operator\LogicalAnd;

class FourLeggedAnimal extends DelagatingSpecification
{
    /**
     * @var string
     */
    private $animal;

    public function __construct($animal)
    {
        $this->animal = $animal;

        $this->delegateTo(new LogicalAnd(
            new Equals('animal', $animal),
            new Equals('numberOfLegs', 4)
        ));
    }

    public function getAnimal()
    {
        return $this->animal;
    }
}
