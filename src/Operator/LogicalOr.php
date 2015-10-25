<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueExtractor;
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

    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor)
    {
        foreach ($this->childSpecifications as $childSpecification) {
            if ($childSpecification->isSpecifiedBy($input, $propertyValueExtractor)) {
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
