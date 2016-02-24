<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;

class Not implements Specification
{
    /**
     * @var Specification
     */
    private $childSpecification;

    /**
     * @param Specification $childSpecification
     */
    public function __construct(Specification $childSpecification)
    {
        $this->childSpecification = $childSpecification;
    }

    public function isSpecifiedBy($input, PropertyValueManipulator $propertyValueManipulator)
    {
        return ! $this->childSpecification->isSpecifiedBy($input, $propertyValueManipulator);
    }

    public function getAllSpecifications()
    {
        return array_merge(
            [$this],
            $this->childSpecification->getAllSpecifications()
        );
    }
}
