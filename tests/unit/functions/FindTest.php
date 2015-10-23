<?php

namespace Monii\Specification\Tests\Unit\functions;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Operator\LogicalAnd;
use Monii\Specification\Operator\LogicalOr;
use Monii\Specification\Operator\Page;
use Monii\Specification\Operator\PerPage;
use PHPUnit_Framework_TestCase;
use function Monii\Specification\find;

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
            find($specification, LogicalAnd::class)
        );

        $this->assertEquals(
            [$orSpecification],
            find($specification, LogicalOr::class)
        );

        $this->assertEquals(
            [$equalsOneSpecification, $equalsTwoSpecification, $equalsThreeSpecification],
            find($specification, Equals::class)
        );

        $this->assertEquals(
            [new Page(3, $orSpecification)],
            find($specification, Page::class)
        );

        $this->assertEquals(
            [new PerPage(5, new Page(3, $orSpecification))],
            find($specification, PerPage::class)
        );
    }
}
