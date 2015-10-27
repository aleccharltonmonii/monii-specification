<?php

namespace Monii\Specification\Tests\Unit\Property\Normalizer;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Property\Extractor\PublicGetterExtractor;
use Monii\Specification\Property\Normalizer\PassthroughNormalizer;
use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;
use Monii\Specification\Tests\Fixtures\Pet;
use PHPUnit_Framework_TestCase;

class PassthroughNormalizerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideSuccessData
     */
    public function testSuccess(
        Specification $specification,
        $object,
        PropertyValueExtractor $propertyValueExtractor
    ) {
        $propertyValueManipulator = new PropertyValueManipulator(
            $propertyValueExtractor,
            new PassthroughNormalizer()
        );

        $this->assertTrue($specification->isSpecifiedBy($object, $propertyValueManipulator));
    }

    public function provideSuccessData()
    {
        return [
            [
                new Equals('animal', 'cat'),
                new Pet('cat', 4),
                new PublicGetterExtractor(),
            ],
        ];
    }
}
