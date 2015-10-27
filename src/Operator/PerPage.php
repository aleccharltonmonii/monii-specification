<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;

class PerPage implements Specification
{
    /**
     * @var int
     */
    private $perPage;

    /**
     * @var Specification|null
     */
    private $childSpecification;

    public function __construct($perPage, Specification $specification = null)
    {
        $this->perPage = $perPage;
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
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
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
