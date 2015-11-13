<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;

class In implements Specification
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $values;

    public function __construct($field, $values = [])
    {
        $this->field = $field;
        $this->values = $values;
    }

    public function getAllSpecifications()
    {
        return [$this];
    }

    public function isSpecifiedBy($input, PropertyValueManipulator $propertyValueManipulator)
    {
        if (empty($this->values)) {
            return false;
        }

        $actualValue = $propertyValueManipulator->extractPropertyValue($input, $this->field);
        $actualValue = $propertyValueManipulator->normalizePropertyValue($input, $this->field, $actualValue);

        foreach ($this->values as $value) {
            $expectedValue = $propertyValueManipulator->normalizeValue($input, $this->field, $value);

            if ($actualValue == $expectedValue) {
                return true;
            }

        }

        return false;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }
}
