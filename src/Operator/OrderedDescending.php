<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Specification;

class OrderedDescending implements Specification
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var Specification
     */
    private $specification;

    public function __construct($field, Specification $specification)
    {
        $this->field = $field;
        $this->specification = $specification;
    }

    public function render(callable $render)
    {
        $render($this->field, $this->specification);
    }

    public function getAllSpecifications()
    {
        return [$this];
    }

    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor)
    {
        return true;
    }
}
