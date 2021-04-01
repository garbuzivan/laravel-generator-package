<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Form;

use GarbuzIvan\LaravelGeneratorPackage\Form\Filter;

class FilterTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * Test create filter
     */
    public function testFilterInit()
    {
        $filter = app(Filter::class);
        $this->assertTrue($filter->setType('int')->getType() == 'int');
    }

    /**
     * Test required
     */
    public function tesRequired()
    {
        $filter = app(Filter::class);
        $this->assertFalse($filter->required(false)->getRequired());
    }

    /**
     * Test required
     */
    public function tesMax()
    {
        $filter = app(Filter::class);
        $this->assertTrue($filter->max(123)->getMax() == 123);
    }

    /**
     * Test required
     */
    public function tesMin()
    {
        $filter = app(Filter::class);
        $this->assertTrue($filter->min(321)->getMin() == 321);
    }
}
