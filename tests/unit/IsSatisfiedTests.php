<?php

namespace Monii\Specification\Tests\Unit;

use Monii\Specification\Property\Extractor\PublicGetterExtractor;
use Monii\Specification\Specification;
use PHPUnit_Framework_Assert as Assert;

trait IsSatisfiedTests
{
    /**
     * @param object $object
     * @dataProvider provideIsSatisfiedBySuccessData
     */
    public function testIsSatisfiedBySuccess(Specification $specification, $object)
    {
        Assert::assertTrue($specification->isSpecifiedBy($object, new PublicGetterExtractor()));
    }

    /**
     * Provide success data for isSatisifiedBy test
     *
     * Expected to return array arguments of:
     *
     * <code>(Specification $specification, $object)</code>
     *
     * @return array
     */
    abstract public function provideIsSatisfiedBySuccessData();

    /**
     * Provide failure data for isSatisifiedBy test
     *
     * Expected to return array arguments of:
     *
     * <code>(Specification $specification, $object)</code>
     *
     * @dataProvider provideIsSatisfiedByFailureData
     */
    public function testIsSatisfiedByFailure(Specification $specification, $object)
    {
        Assert::assertFalse($specification->isSpecifiedBy($object, new PublicGetterExtractor()));
    }

    /**
     * @return array
     */
    abstract public function provideIsSatisfiedByFailureData();
}
