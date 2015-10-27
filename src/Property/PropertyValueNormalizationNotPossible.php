<?php

namespace Monii\Specification\Property;

use RuntimeException;

class PropertyValueNormalizationNotPossible extends RuntimeException
{
    /**
     * @var PropertyValueNormalizationNotPossible[]
     */
    private $subExceptions = [];

    /**
     * @param object $propertyValueNormalizer
     * @param object $targetObject
     * @param string $propertyName
     * @param array $subExceptions
     */
    public function __construct(
        $propertyValueNormalizer,
        $targetObject,
        $propertyName,
        array $subExceptions = []
    ) {
        $message = sprintf(
            'Could not normalize property "%s" value from %s using %s',
            $propertyName,
            get_class($targetObject),
            get_class($propertyValueNormalizer)
        );

        parent::__construct($message);

        $this->subExceptions = $subExceptions;
    }
}
