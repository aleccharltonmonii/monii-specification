<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;

class Equals implements Specification
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $value;

    public function __construct($field, $value = null)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function getAllSpecifications()
    {
        return [$this];
    }

    public function isSpecifiedBy($input, PropertyValueManipulator $propertyValueManipulator)
    {
        $actualValue = $propertyValueManipulator->extractPropertyValue($input, $this->field);
        $actualValue = $propertyValueManipulator->normalizePropertyValue($input, $this->field, $actualValue);
        $expectedValue = $propertyValueManipulator->normalizeValue($input, $this->field, $this->value);

        return $actualValue == $expectedValue;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
