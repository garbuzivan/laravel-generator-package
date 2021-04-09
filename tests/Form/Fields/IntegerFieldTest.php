<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Form\Fields;

use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;

class IntegerFieldTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * Test create field
     */
    public function testIntegerFieldInit()
    {
        $field = Field::integer('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }
}
