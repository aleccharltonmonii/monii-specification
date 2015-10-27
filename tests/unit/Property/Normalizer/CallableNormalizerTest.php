<?php

namespace Monii\Specification\Tests\Unit\Property\Normalizer;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Property\Extractor\PublicGetterExtractor;
use Monii\Specification\Property\Normalizer\CallableNormalizer;
use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;
use Monii\Specification\Tests\Fixtures\Pet;
use PHPUnit_Framework_TestCase;

class CallableNormalizerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideSuccessData
     */
    public function testSuccess(
        Specification $specification,
        $object,
        PropertyValueExtractor $propertyValueExtractor,
        callable $propertyValueNormalizer
    ) {
        $propertyValueManipulator = new PropertyValueManipulator(
            $propertyValueExtractor,
            new CallableNormalizer($propertyValueNormalizer)
        );

        $this->assertTrue($specification->isSpecifiedBy($object, $propertyValueManipulator));
    }

    public function provideSuccessData()
    {
        return [
            'case-insensitive' => [
                new Equals('animal', 'cat'),
                new Pet('CAT', 4),
                new PublicGetterExtractor(),
                function ($targetObject, $propertyName, $value = null) {
                    // make the test case-insensitive.
                    return strtolower($value);
                }
            ],
            'remove spaces' => [
                new Equals('animal', 'cat'),
                new Pet('CAT', 4),
                new PublicGetterExtractor(),
                function ($targetObject, $propertyName, $value = null) {
                    // make the test case-insensitive.
                    return strtolower($value);
                }
            ],
        ];
    }
}
