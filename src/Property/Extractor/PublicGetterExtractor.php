<?php

namespace Monii\Specification\Property\Extractor;

use Monii\Specification\Property\PropertyValueExtractor;

class PublicGetterExtractor implements PropertyValueExtractor
{
    public function extractPropertyValueFrom($targetObject, $propertyName)
    {
        $methodName = $this->getMethodNameForProperty($propertyName);

        return $targetObject->$methodName();
    }

    public function supportsExtractionOfProperty($targetObject, $propertyName)
    {
        if (method_exists($targetObject, $this->getMethodNameForProperty($propertyName))) {
            return true;
        }

        return false;
    }

    private function getMethodNameForProperty($propertyName)
    {
        return 'get'.ucfirst($propertyName);
    }
}
