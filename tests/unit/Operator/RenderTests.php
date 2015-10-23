<?php

namespace Monii\Specification\Tests\Unit\Operator;

use Monii\Specification\Specification;
use PHPUnit_Framework_Assert as Assert;

trait RenderTests
{
    /**
     * @dataProvider provideRenderData
     */
    public function testRender(
        Specification $specification,
        $expectedArguments
    ) {
        $specification->render(function () use ($expectedArguments) {
            Assert::assertEquals($expectedArguments, func_get_args());
        });
    }

    /**
     * Provide data for render test
     *
     * Expected to return array arguments of:
     *
     * <code>(Specification $specification, array $expectedArguments)</code>
     *
     * The <code>$expectedArguments</code> are the values that would be expected to be sent to the render callback.
     *
     * @return array
     */
    abstract public function provideRenderData();
}
