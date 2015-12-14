<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;

class OrderedDescending implements Specification
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var Specification|null
     */
    private $childSpecification;

    public function __construct($field, Specification $specification = null)
    {
        $this->field = $field;
        $this->childSpecification = $specification;
    }

    public function getAllSpecifications()
    {
        $allSpecifications = [$this];
        if (! is_null($this->childSpecification)) {
            $allSpecifications = array_merge(
                $allSpecifications,
                $this->childSpecification->getAllSpecifications()
            );
        }

        return $allSpecifications;
    }

    public function isSpecifiedBy($input, PropertyValueManipulator $propertyValueManipulator)
    {
        return true;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return Specification|null
     */
    public function getChildSpecification()
    {
        return $this->childSpecification;
    }

    /**
     * @return bool
     */
    public function hasChildSpecification()
    {
        return ! is_null($this->childSpecification);
    }

    /**
     * @return bool
     */
    public function doesNotHaveChildSpecification()
    {
        return is_null($this->childSpecification);
    }
}
