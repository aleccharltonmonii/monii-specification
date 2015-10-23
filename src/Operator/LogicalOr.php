<?php

namespace Monii\Specification\Operator;

use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Specification;

class LogicalOr implements Specification
{
    /**
     * @var Specification[]
     */
    private $children;

    public function __construct()
    {
        $this->children = func_get_args();
    }

    public function render(callable $render)
    {
        $render($this->children);
    }

    public function getAllSpecifications()
    {
        return array_merge([$this], $this->children);
    }

    public function isSpecifiedBy($input, PropertyValueExtractor $propertyValueExtractor)
    {
        foreach ($this->children as $child) {
            if ($child->isSpecifiedBy($input, $propertyValueExtractor)) {
                return true;
            }
        }

        return false;
    }
}
