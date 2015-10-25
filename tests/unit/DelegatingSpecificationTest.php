<?php

namespace Monii\Specification\Tests\Unit;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Operator\LogicalAnd;
use Monii\Specification\Tests\Fixtures\FourLeggedAnimal;
use Monii\Specification\Tests\Fixtures\Pet;
use PHPUnit_Framework_TestCase;

class DelegatingSpecificationTest extends PHPUnit_Framework_TestCase
{
    use IsSatisfiedTests;

    public function provideIsSatisfiedBySuccessData()
    {
        return [
            [
                new FourLeggedAnimal('dog'),
                new Pet('dog', 4),
            ],
        ];
    }

    public function provideIsSatisfiedByFailureData()
    {
        return [
            'three legged dog fails' => [
                new FourLeggedAnimal('dog'),
                new Pet('dog', 3),
            ],
            'four legged cat fails' => [
                new FourLeggedAnimal('dog'),
                new Pet('cat', 4),
            ],
        ];
    }

    public function provideRenderData()
    {
        return [
            'render four legged dog' => [
                new FourLeggedAnimal('dog'),
                [
                    new LogicalAnd(
                        new Equals('animal', 'dog'),
                        new Equals('numberOfLegs', 4)
                    ),
                ]
            ],
            'render four legged cat' => [
                new FourLeggedAnimal('cat'),
                [
                    new LogicalAnd(
                        new Equals('animal', 'cat'),
                        new Equals('numberOfLegs', 4)
                    ),
                ]
            ],
        ];
    }
}
