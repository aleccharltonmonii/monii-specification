<?php

namespace Monii\Specification\Property\Extractor;

use Monii\Specification\Property\PropertyValueExtractionNotPossible;
use Monii\Specification\Property\PropertyValueExtractor;

class PublicGetterExtractor implements PropertyValueExtractor
{
    public function supportsExtractionOfPropertyValue($targetObject, $propertyName)
    {
        if (method_exists($targetObject, $this->getMethodNameForProperty($propertyName))) {
            return true;
        }

        return false;
    }

    public function extractPropertyValueFrom($targetObject, $propertyName)
    {
        $methodName = $this->getMethodNameForProperty($propertyName);

        if (! method_exists($targetObject, $methodName)) {
            throw new PropertyValueExtractionNotPossible(
                $this,
                $targetObject,
                $propertyName
            );
        }

        return $targetObject->$methodName();
    }

    private function getMethodNameForProperty($propertyName)
    {
        return 'get'.ucfirst($propertyName);
    }
}
