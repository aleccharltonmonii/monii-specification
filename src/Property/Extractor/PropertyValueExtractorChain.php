<?php

namespace Monii\Specification\Property\Extractor;

use Monii\Specification\Property\PropertyValueExtractionNotPossible;
use Monii\Specification\Property\PropertyValueExtractor;

class PropertyValueExtractorChain implements PropertyValueExtractor
{
    /**
     * @var PropertyValueExtractor[]
     */
    private $propertyValueExtractors = [];

    public function __construct(array $propertyValueExtractors)
    {
        $this->propertyValueExtractors = $propertyValueExtractors;
    }

    public function extractPropertyValueFrom($targetObject, $propertyName)
    {
        $subExceptions = [];

        foreach ($this->propertyValueExtractors as $propertyValueExtractor) {
            try {
                return $propertyValueExtractor->extractPropertyValueFrom($targetObject, $propertyName);
            } catch (PropertyValueExtractionNotPossible $e) {
                $subExceptions[] = $e;

                continue;
            }
        }

        throw new PropertyValueExtractionNotPossible($this, $targetObject, $propertyName, $subExceptions);
    }

    public function supportsExtractionOfProperty($targetObject, $propertyName)
    {
        foreach ($this->propertyValueExtractors as $propertyValueExtractor) {
            if ($propertyValueExtractor->supportsExtractionOfProperty($targetObject, $propertyName)) {
                return true;
            }
        }

        return false;
    }
}
