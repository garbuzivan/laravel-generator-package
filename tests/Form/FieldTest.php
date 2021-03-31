<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form;

use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    public function testFieldInit()
    {
        Field::text('title', 'Title');
        $this->assertIsBool(true);
    }
}
