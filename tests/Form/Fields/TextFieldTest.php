<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form\Fields;

use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use Tests\TestCase;

class TextFieldTest extends TestCase
{
    /**
     * Test create field
     */
    public function testTextFieldInit()
    {
        $field = Field::text('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }
}
