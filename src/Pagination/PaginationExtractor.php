<?php

namespace Monii\Specification\Pagination;

use Monii\Specification\Operator\Page;
use Monii\Specification\Operator\PerPage;
use Monii\Specification\Specification;
use Monii\Specification\SpecificationSearch;

class PaginationExtractor
{
    public static function extract(Specification $specification)
    {
        /** @var PerPage $perPageSpecification */
        $perPageSpecification = SpecificationSearch::findFirstOrNull($specification, PerPage::class);

        /** @var Page $pageSpecification */
        $pageSpecification = SpecificationSearch::findFirstOrNull($specification, Page::class);

        return new Pagination(
            $perPageSpecification ? $perPageSpecification->getPerPage() : null,
            $pageSpecification ? $pageSpecification->getPage() : null
        );
    }
}
