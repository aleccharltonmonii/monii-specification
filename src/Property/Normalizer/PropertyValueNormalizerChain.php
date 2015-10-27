<?php

namespace Monii\Specification\Property\Normalizer;

use Monii\Specification\Property\PropertyValueNormalizationNotPossible;
use Monii\Specification\Property\PropertyValueNormalizer;

class PropertyValueNormalizerChain implements PropertyValueNormalizer
{
    /**
     * @var PropertyValueNormalizer[]
     */
    private $propertyValueNormalizers = [];

    public function __construct(array $propertyValueNormalizers)
    {
        $this->propertyValueNormalizers = $propertyValueNormalizers;
    }

    public function supportsNormalizationOfPropertyValue($targetObject, $propertyName, $value = null)
    {
        foreach ($this->propertyValueNormalizers as $propertyValueNormalizer) {
            if ($propertyValueNormalizer->supportsNormalizationOfPropertyValue($targetObject, $propertyName)) {
                return true;
            }
        }

        return false;
    }

    public function normalizePropertyValueFrom($targetObject, $propertyName, $value = null)
    {
        $subExceptions = [];

        foreach ($this->propertyValueNormalizers as $propertyValueNormalizer) {
            try {
                return $propertyValueNormalizer->normalizePropertyValueFrom($targetObject, $propertyName);
            } catch (PropertyValueNormalizationNotPossible $e) {
                $subExceptions[] = $e;

                continue;
            }
        }

        throw new PropertyValueNormalizationNotPossible($this, $targetObject, $propertyName, $subExceptions);
    }

    public function normalizeValueFor($targetObject, $propertyName, $value = null)
    {
        $subExceptions = [];

        foreach ($this->propertyValueNormalizers as $propertyValueNormalizer) {
            try {
                return $propertyValueNormalizer->normalizeValueFor($targetObject, $propertyName);
            } catch (PropertyValueNormalizationNotPossible $e) {
                $subExceptions[] = $e;

                continue;
            }
        }

        throw new PropertyValueNormalizationNotPossible($this, $targetObject, $propertyName, $subExceptions);
    }
}
