<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Specification;

class Page implements Specification
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var Specification|null
     */
    private $childSpecification;

    public function __construct($page, Specification $specification = null)
    {
        $this->page = $page;
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

    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor)
    {
        return true;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
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
