<?php

namespace Monii\Specification\Property;

use RuntimeException;

class PropertyValueExtractionNotPossible extends RuntimeException
{
    /**
     * @var PropertyValueExtractionNotPossible[]
     */
    private $subExceptions = [];

    /**
     * @param object $propertyValueExtractor
     * @param object $targetObject
     * @param string $propertyName
     * @param array $subExceptions
     */
    public function __construct(
        $propertyValueExtractor,
        $targetObject,
        $propertyName,
        array $subExceptions = []
    ) {
        $message = sprintf(
            'Could not extract property "%s" value from %s using %s',
            $propertyName,
            get_class($targetObject),
            get_class($propertyValueExtractor)
        );

        parent::__construct($message);

        $this->subExceptions = $subExceptions;
    }
}
