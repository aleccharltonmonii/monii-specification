<?php

namespace Monii\Specification\Tests\Unit\functions;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Operator\LogicalAnd;
use Monii\Specification\Operator\LogicalOr;
use Monii\Specification\Operator\Page;
use Monii\Specification\Operator\PerPage;
use PHPUnit_Framework_TestCase;
use function Monii\Specification\find_first_or_null;

class FindFirstOrNullTest extends PHPUnit_Framework_TestCase
{
    public function testFindFirstOrNull()
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

        $this->assertNull(find_first_or_null($specification, LogicalAnd::class));

        $this->assertEquals(
            $orSpecification,
            find_first_or_null($specification, LogicalOr::class)
        );

        $this->assertEquals(
            $equalsOneSpecification,
            find_first_or_null($specification, Equals::class)
        );

        $this->assertEquals(
            new Page(3, $orSpecification),
            find_first_or_null($specification, Page::class)
        );

        $this->assertEquals(
            new PerPage(5, new Page(3, $orSpecification)),
            find_first_or_null($specification, PerPage::class)
        );
    }
}
