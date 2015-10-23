<?php

namespace Monii\Specification;

use Monii\Specification\Property\PropertyValueExtractor;

interface Specification
{
    /**
     * Is the given object specified by this specification?
     *
     * @param object $input
     * @param PropertyValueExtractor $propertyValueExtractor
     *
     * @return bool
     */
    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor);

    /**
     * Render the specification.
     *
     * @param callable $render
     * @return void
     */
    public function render(callable $render);

    /**
     * Get all specifications.
     *
     * @return Specification[]
     */
    public function getAllSpecifications();
}
