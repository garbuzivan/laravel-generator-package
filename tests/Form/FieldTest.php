<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use Tests\TestCase;

class FieldTest extends TestCase
{
    public function testFieldInit()
    {
        $field = Field::text('title', 'Title');
        var_dump($field->getLabel(), 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }

    public function testFieldInitExceptionTypeColumn()
    {
        $this->expectException(Exception::class);
        Field::text(123, 'Title');
    }

    public function testFieldInitExceptionMaskColumn()
    {
        $this->expectException(Exception::class);
        Field::text('проверка', 'Title');
    }
}
