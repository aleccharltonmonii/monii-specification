<?php

namespace Monii\Specification\Property\Normalizer;

use Monii\Specification\Property\PropertyValueNormalizer;

class CallableNormalizer implements PropertyValueNormalizer
{
    /**
     * @var callable
     */
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function supportsNormalizationOfPropertyValue($targetObject, $propertyName, $value = null)
    {
        return true;
    }

    public function normalizePropertyValueFrom($targetObject, $propertyName, $value = null)
    {
        $callable = $this->callable;

        return $callable($targetObject, $propertyName, $value);
    }

    public function normalizeValueFor($targetObject, $propertyName, $value = null)
    {
        $callable = $this->callable;

        return $callable($targetObject, $propertyName, $value);
    }
}
