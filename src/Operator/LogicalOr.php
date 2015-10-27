<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;

class LogicalOr implements Specification
{
    /**
     * @var Specification[]
     */
    private $childSpecifications;

    public function __construct()
    {
        $this->childSpecifications = func_get_args();
    }

    public function getAllSpecifications()
    {
        $allSpecifications = [$this];
        foreach ($this->childSpecifications as $childSpecification) {
            $allSpecifications = array_merge($allSpecifications, $childSpecification->getAllSpecifications());
        }

        return $allSpecifications;
    }

    public function isSpecifiedBy($input, PropertyValueManipulator $propertyValueManipulator)
    {
        foreach ($this->childSpecifications as $childSpecification) {
            if ($childSpecification->isSpecifiedBy($input, $propertyValueManipulator)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Specification[]
     */
    public function getChildSpecifications()
    {
        return $this->childSpecifications;
    }
}
