<?php

namespace Monii\Specification;
use Monii\Specification\Operator\Page;
use Monii\Specification\Operator\PerPage;
use Monii\Specification\Pagination\Pagination;

/**
 * @param Specification $specification
 * @param string $className
 * @return Specification[]
 */
function find(Specification $specification, $className)
{
    $filter = function ($subSpecification) use ($className) {
        return $subSpecification instanceof $className;
    };

    return array_values(array_filter($specification->getAllSpecifications(), $filter));
}

/**
 * @param Specification $specification
 * @param string $className
 * @return Specification|null
 */
function find_first_or_null(Specification $specification, $className)
{
    $specifications = find($specification, $className);

    if (count($specifications) < 1) {
        return null;
    }

    return array_values($specifications)[0];
}

/**
 * @param Specification $specification
 * @return Pagination
 */
function extract_pagination(Specification $specification)
{
    /** @var PerPage $perPageSpecification */
    $perPageSpecification = \Monii\Specification\find_first_or_null($specification, PerPage::class);

    /** @var Page $pageSpecification */
    $pageSpecification = \Monii\Specification\find_first_or_null($specification, Page::class);

    return new Pagination(
        $perPageSpecification ? $perPageSpecification->getPerPage() : null,
        $pageSpecification ? $pageSpecification->getPage() : null
    );
}
