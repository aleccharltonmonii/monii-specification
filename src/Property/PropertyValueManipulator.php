<?php

namespace Monii\Specification\Property;

class PropertyValueManipulator
{
    /**
     * @var PropertyValueExtractor
     */
    private $propertyValueExtractor;

    /**
     * @var PropertyValueNormalizer
     */
    private $propertyValueNormalizer;

    /**
     * PropertyValueManipulator constructor.
     *
     * @param PropertyValueExtractor $propertyValueExtractor
     * @param PropertyValueNormalizer $propertyValueNormalizer
     */
    public function __construct(
        PropertyValueExtractor $propertyValueExtractor,
        PropertyValueNormalizer $propertyValueNormalizer
    ) {
        $this->propertyValueExtractor = $propertyValueExtractor;
        $this->propertyValueNormalizer = $propertyValueNormalizer;
    }

    /**
     * @param object $targetObject
     * @param string $propertyName
     * @return mixed
     */
    public function extractPropertyValue($targetObject, $propertyName)
    {
        return $this->propertyValueExtractor->extractPropertyValueFrom($targetObject, $propertyName);
    }

    /**
     * @param object $targetObject
     * @param string $propertyName
     * @param mixed|null $value
     * @return mixed|null
     */
    public function normalizePropertyValue($targetObject, $propertyName, $value = null)
    {
        return $this->propertyValueNormalizer->normalizePropertyValueFrom($targetObject, $propertyName, $value);
    }

    /**
     * @param object $targetObject
     * @param string $propertyName
     * @param mixed|null $value
     * @return mixed|null
     */
    public function normalizeValue($targetObject, $propertyName, $value = null)
    {
        return $this->propertyValueNormalizer->normalizeValueFor($targetObject, $propertyName, $value);
    }
}
