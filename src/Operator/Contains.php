<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;

class Contains implements Specification
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var bool
     */
    private $isCaseSensitive;

    public function __construct($field, $value = null, $caseSensitive = false)
    {
        $this->field = $field;
        $this->value = $value;
        $this->isCaseSensitive = $caseSensitive;
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

        if (! $this->isCaseSensitive) {
            $actualValue = strtolower($actualValue);
            $expectedValue = strtolower($expectedValue);
        }

        return strpos($actualValue, $expectedValue) !== false;
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

    /**
     * @return bool
     */
    public function isCaseSensitive()
    {
        return $this->isCaseSensitive;
    }
}
