<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form;

use GarbuzIvan\LaravelGeneratorPackage\Form\Filter;
use Tests\TestCase;

class FilterTest extends TestCase
{
    /**
     * Test create filter
     */
    public function testFilterInit()
    {
        $filter = new Filter();
        $this->assertTrue($filter->setType('int')->getType() == 'int');
    }

    /**
     * Test required
     */
    public function tesRequired()
    {
        $filter = new Filter();
        $this->assertFalse($filter->required(false)->getRequired());
    }

    /**
     * Test required
     */
    public function tesMax()
    {
        $filter = new Filter();
        $this->assertTrue($filter->max(123)->getMax() == 123);
    }

    /**
     * Test required
     */
    public function tesMin()
    {
        $filter = new Filter();
        $this->assertTrue($filter->min(321)->getMin() == 321);
    }
}
