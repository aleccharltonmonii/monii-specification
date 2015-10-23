<?php

namespace Monii\Specification\Property\Extractor;

use Monii\Specification\Property\PropertyValueExtractor;

class CallableExtractor implements PropertyValueExtractor
{
    /**
     * @var callable
     */
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function extractPropertyValueFrom($targetObject, $propertyName)
    {
        $callable = $this->callable;

        return $callable($targetObject, $propertyName);
    }

    public function supportsExtractionOfProperty($targetObject, $propertyName)
    {
        return true;
    }
}
