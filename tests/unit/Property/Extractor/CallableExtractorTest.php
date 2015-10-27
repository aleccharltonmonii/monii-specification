<?php

namespace Monii\Specification\Tests\Unit\Property\Extractor;

use Monii\Specification\Operator\Equals;
use Monii\Specification\Property\Extractor\CallableExtractor;
use Monii\Specification\Property\Normalizer\PassthroughNormalizer;
use Monii\Specification\Property\PropertyValueExtractor;
use Monii\Specification\Property\PropertyValueManipulator;
use Monii\Specification\Specification;
use Monii\Specification\Tests\Fixtures\Pet;
use PHPUnit_Framework_TestCase;

class CallableExtractorTest extends PHPUnit_Framework_TestCase
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
                new Equals('__animal__', 'cat'),
                new Pet('cat', 4),
                new CallableExtractor(function (Pet $pet, $propertyName) {
                    switch($propertyName) {
                        case '__animal__':
                            return $pet->getAnimal();
                        default:
                            $this->fail('Unexpected input; wrong field name?');
                    }

                    return null;
                }),
            ],
        ];
    }
}
