<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Specification;

class PerPage implements Specification
{
    /**
     * @var int
     */
    private $perPage;

    /**
     * @var Specification
     */
    private $specification;

    public function __construct($perPage, Specification $specification = null)
    {
        $this->perPage = $perPage;
        $this->specification = $specification;
    }

    public function render(callable $render)
    {
        $render($this->perPage, $this->specification);
    }

    public function getAllSpecifications()
    {
        $allSpecifications = [$this];
        if (! is_null($this->specification)) {
            $allSpecifications = array_merge(
                $allSpecifications,
                $this->specification->getAllSpecifications()
            );
        }

        return $allSpecifications;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor)
    {
        return true;
    }
}
