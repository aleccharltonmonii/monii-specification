<?php

namespace Monii\Unit\Specification\Operator;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Tests\Fixtures\ObjectWithGetters;
use Monii\Specification\Tests\Unit\IsSatisfiedTests;
use PHPUnit_Framework_TestCase;

class EqualsTest extends PHPUnit_Framework_TestCase
{
    use IsSatisfiedTests;

    public function provideIsSatisfiedBySuccessData()
    {
        return [
            'Property "one" has value "One"' => [
                new Equals('one', 'One'),
                ObjectWithGetters::create()->withOne('One'),
            ],
        ];
    }

    public function provideIsSatisfiedByFailureData()
    {
        return [
            'Property "one" has value "One" but specification is configured for value "ONE"' => [
                new Equals('one', 'ONE'),
                ObjectWithGetters::create()->withOne('One')
            ],
        ];
    }

    public function provideRenderData()
    {
        return [
            [
                new Equals('one', 'One'),
                ['one', 'One'],
            ]
        ];
    }
}
