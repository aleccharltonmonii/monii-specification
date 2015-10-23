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
     * @var Specification
     */
    private $specification;

    public function __construct($page, Specification $specification = null)
    {
        $this->page = $page;
        $this->specification = $specification;
    }

    public function render(callable $render)
    {
        $render($this->page, $this->specification);
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

    public function getPage()
    {
        return $this->page;
    }

    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor)
    {
        return true;
    }
}
