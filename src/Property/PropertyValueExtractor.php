<?php

namespace Monii\Specification\Property;

interface PropertyValueExtractor
{
    /**
     * Do we support extracting a value for this property of this object?
     *
     * @param object $targetObject
     * @param string $propertyName
     * @return bool
     */
    public function supportsExtractionOfPropertyValue($targetObject, $propertyName);

    /**
     * Extract a value for a property from an object.
     *
     * @param object $targetObject
     * @param string $propertyName
     * @return mixed
     */
    public function extractPropertyValueFrom($targetObject, $propertyName);
}
