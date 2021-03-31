<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    public function testFieldInit()
    {
        $field = Field::text('title', 'Title');
        $this->assertIsBool($field->getColumn() == 'title');
        $this->assertIsBool($field->getLabel() == 'Title');
    }

    public function testFieldInitExceptionTypeColumn()
    {
        Field::text(123, 'Title');
        $this->expectException(Exception::class);
    }

    public function testFieldInitExceptionMaskColumn()
    {
        Field::text('проверка', 'Title');
        $this->expectException(Exception::class);
    }
}
