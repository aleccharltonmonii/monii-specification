<?php

namespace Monii\Specification\Property;

interface PropertyValueNormalizer
{
    /**
     * Do we support normalizing a value for this property of this object?
     *
     * @param object $targetObject
     * @param string $propertyName
     * @param mixed|null $value
     * @return bool
     */
    public function supportsNormalizationOfPropertyValue($targetObject, $propertyName, $value = null);

    /**
     * Normalize a value for a property from an object.
     *
     * @param object $targetObject
     * @param string $propertyName
     * @param mixed|null $value
     * @return mixed|null
     */
    public function normalizePropertyValueFrom($targetObject, $propertyName, $value = null);

    /**
     * Normalize a value.
     *
     * @param object $targetObject
     * @param string $propertyName
     * @param mixed|null $value
     * @return mixed|null
     */
    public function normalizeValueFor($targetObject, $propertyName, $value = null);
}
