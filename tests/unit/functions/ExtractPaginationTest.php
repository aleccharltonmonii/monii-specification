<?php

namespace Monii\Specification\Tests\Unit\functions;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Operator\LogicalAnd;
use Monii\Specification\Operator\Page;
use Monii\Specification\Operator\PerPage;
use Monii\Specification\Pagination\Pagination;
use Monii\Specification\Specification;
use PHPUnit_Framework_TestCase;

class ExtractPaginationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param Specification $specification
     * @param Pagination $expectedPagination
     * @dataProvider provideData
     */
    public function test(Specification $specification, Pagination $expectedPagination)
    {
        $this->assertEquals(
            $expectedPagination,
            \Monii\Specification\extract_pagination($specification)
        );
    }

    public function provideData()
    {
        return [
            'no pagination' => [
                new Equals('no', 'pagination'),
                Pagination::createWithoutPagingInformation(),
            ],
            'per page only (outer)' => [
                new PerPage(3, new Equals('pagination', 'per page')),
                Pagination::createWithPerPageOnly(3),
            ],
            'page only (outer)' => [
                new Page(5, new Equals('pagination', 'per page')),
                Pagination::createWithPageOnly(5),
            ],
            'both (per page outer)' => [
                new PerPage(3, new Page(5, new Equals('pagination', 'per page, page'))),
                Pagination::createWithPerPageAndPage(3, 5),
            ],
            'both (page outer)' => [
                new Page(5, new PerPage(3, new Equals('pagination', 'page, per page'))),
                Pagination::createWithPerPageAndPage(3, 5),
            ],
            'both (page outer, wrapped in Logical And)' => [
                new LogicalAnd(new Page(5, new PerPage(3, new Equals('pagination', 'and(page, per page)')))),
                Pagination::createWithPerPageAndPage(3, 5),
            ],
        ];
    }
}
