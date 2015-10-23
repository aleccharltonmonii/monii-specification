<?php

namespace Monii\Specification;

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
