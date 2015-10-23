<?php

namespace Monii\Specification;

use RuntimeException;

class DelegatingSpecificationNotConfigured extends RuntimeException
{
    /**
     * @param DelegatingSpecification $object
     * @return DelegatingSpecificationNotConfigured
     */
    public static function forObject($object)
    {
        $message = sprintf(
            'Delegate specification was not configured. (Did you forget to call `delegateTo` in %s?)',
            get_class($object)
        );

        return new self($message);
    }
}
