<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use Tests\TestCase;

class FieldTest extends TestCase
{
    /**
     * Test create field
     */
    public function testFieldInit()
    {
        $field = Field::text('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }

    /**
     * Test Exception Type Column
     */
    public function testFieldInitExceptionTypeColumn()
    {
        $this->expectException(Exception::class);
        Field::text(123, 'Title');
    }

    /**
     * Test Exception Mask Column
     */
    public function testFieldInitExceptionMaskColumn()
    {
        $this->expectException(Exception::class);
        Field::text('проверка', 'Title');
    }
}
