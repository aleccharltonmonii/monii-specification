<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueExtractor;
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

    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor)
    {
        $actualValue = $propertyValueExtractor->extractPropertyValueFrom($input, $this->field);

        return $actualValue === $this->value;
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
