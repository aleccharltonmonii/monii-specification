<?php

namespace Monii\Specification;

use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Property\PropertyValueManipulator;

/**
 * A convenience base class for building custom specifications.
 *
 * Class CompositeSpecification
 * @package Monii\Specification
 */
abstract class DelegatingSpecification implements Specification
{
    /**
     * @var Specification
     */
    private $delegateSpecification;

    /**
     * Set the effective specification.
     *
     * @param Specification $delegateSpecification
     */
    protected function delegateTo(Specification $delegateSpecification)
    {
        $this->delegateSpecification = $delegateSpecification;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllSpecifications()
    {
        $this->assertDeleteWasConfigured();

        return array_merge(
            [$this],
            $this->delegateSpecification->getAllSpecifications()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isSpecifiedBy($input, PropertyValueManipulator $propertyValueManipulator)
    {
        $this->assertDeleteWasConfigured();

        return $this->delegateSpecification->isSpecifiedBy($input, $propertyValueManipulator);
    }

    private function assertDeleteWasConfigured()
    {
        if (! is_null($this->delegateSpecification)) {
            return;
        }

        throw DelegatingSpecificationNotConfigured::forObject($this);
    }

    /**
     * @return Specification
     */
    public function getDelegateSpecification()
    {
        $this->assertDeleteWasConfigured();

        return $this->delegateSpecification;
    }
}
