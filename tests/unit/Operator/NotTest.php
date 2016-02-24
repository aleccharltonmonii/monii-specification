<?php

namespace Monii\Specification\Tests\Unit\Operator;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Operator\Not;
use Monii\Specification\Tests\Fixtures\ObjectWithGetters;
use Monii\Specification\Tests\Unit\IsSatisfiedTests;
use PHPUnit_Framework_TestCase;

class NotTest extends PHPUnit_Framework_TestCase
{
    use IsSatisfiedTests;

    public function provideIsSatisfiedBySuccessData()
    {
        return [
            'Property "one" found when looking for value "Two"' => [
                new Not(new Equals('one', 'Two')),
                ObjectWithGetters::create()->withOne('One'),
            ],
        ];
    }

    public function provideIsSatisfiedByFailureData()
    {
        return [
            'Property "one" has value "One" but specification is configured for value "One"' => [
                new Not(new Equals('one', 'ONE')),
                ObjectWithGetters::create()->withOne('ONE')
            ],
        ];
    }
}
