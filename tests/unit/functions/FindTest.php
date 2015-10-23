<?php

namespace Monii\Specification\Tests\Unit\functions;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Operator\LogicalAnd;
use Monii\Specification\Operator\LogicalOr;
use Monii\Specification\Operator\Page;
use Monii\Specification\Operator\PerPage;
use PHPUnit_Framework_TestCase;

class FindTest extends PHPUnit_Framework_TestCase
{
    public function testFind()
    {
        $equalsOneSpecification = new Equals('one', 'ONE');
        $equalsTwoSpecification = new Equals('two', 'TWO');
        $equalsThreeSpecification = new Equals('three', 'THREE');

        $orSpecification = new LogicalOr(
            $equalsOneSpecification,
            $equalsTwoSpecification,
            $equalsThreeSpecification
        );

        $specification = new PerPage(5, new Page(3, $orSpecification));

        $this->assertEquals(
            [],
            \Monii\Specification\find($specification, LogicalAnd::class)
        );

        $this->assertEquals(
            [$orSpecification],
            \Monii\Specification\find($specification, LogicalOr::class)
        );

        $this->assertEquals(
            [$equalsOneSpecification, $equalsTwoSpecification, $equalsThreeSpecification],
            \Monii\Specification\find($specification, Equals::class)
        );

        $this->assertEquals(
            [new Page(3, $orSpecification)],
            \Monii\Specification\find($specification, Page::class)
        );

        $this->assertEquals(
            [new PerPage(5, new Page(3, $orSpecification))],
            \Monii\Specification\find($specification, PerPage::class)
        );
    }
}
