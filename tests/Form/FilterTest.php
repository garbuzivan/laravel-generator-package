<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form;

use GarbuzIvan\LaravelGeneratorPackage\Form\Filter;
use Tests\TestCase;

class FilterTest extends TestCase
{
    /**
     * Test create field
     */
    public function testFilterInit()
    {
        $filter = new Filter();
        $this->assertTrue($filter->setType('int')->getType() == 'int');
    }
}
