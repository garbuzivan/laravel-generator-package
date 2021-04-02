<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Form;

use GarbuzIvan\LaravelGeneratorPackage\Form\Filter;

class FilterTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    protected Filter $filter;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->filter = app(Filter::class);
    }

    /**
     * Test create filter
     */
    public function testFilterInit()
    {

        $this->assertTrue($this->filter->setType('int')->getType() == 'int');
    }

    /**
     * Test required
     */
    public function tesRequired()
    {
        $this->assertFalse($this->filter->required(false)->getRequired());
    }

    /**
     * Test required
     */
    public function tesMax()
    {
        $this->assertTrue($this->filter->max(123)->getMax() == 123);
    }

    /**
     * Test required
     */
    public function tesMin()
    {
        $this->assertTrue($this->filter->min(321)->getMin() == 321);
    }

    /**
     * Test nullable
     */
    public function tesNullable()
    {
        $this->assertTrue($this->filter->nullable()->getNullable());
    }

    /**
     * Test unique
     */
    public function tesUnique()
    {
        $this->assertTrue($this->filter->unique()->getUnique());
    }
}
