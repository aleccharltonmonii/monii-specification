<?php

namespace Monii\Specification\Property\Normalizer;

use Monii\Specification\Property\PropertyValueNormalizer;

class PassthroughNormalizer implements PropertyValueNormalizer
{
    public function supportsNormalizationOfPropertyValue($targetObject, $propertyName, $value = null)
    {
        return true;
    }

    public function normalizePropertyValueFrom($targetObject, $propertyName, $value = null)
    {
        return $value;
    }

    public function normalizeValueFor($targetObject, $propertyName, $value = null)
    {
        return $value;
    }
}
