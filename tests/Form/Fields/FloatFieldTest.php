<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Form\Fields;

use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;

class FloatFieldTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * Test create field
     */
    public function testFloatFieldInit()
    {
        $field = Field::float('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }
}
