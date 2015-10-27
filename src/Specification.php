<?php

namespace Monii\Specification;

use Monii\Specification\Property\PropertyValueManipulator;

interface Specification
{
    /**
     * Is the given object specified by this specification?
     *
     * @param object $input
     * @param PropertyValueManipulator $propertyValueManipulator
     *
     * @return bool
     */
    public function isSpecifiedBy($input, PropertyValueManipulator $propertyValueManipulator);

    /**
     * Get all specifications.
     *
     * @return Specification[]
     */
    public function getAllSpecifications();
}
