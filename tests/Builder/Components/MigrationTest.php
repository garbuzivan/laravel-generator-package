<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Builder;

use GarbuzIvan\LaravelGeneratorPackage\Builder\Components\Migration;
use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase;

class MigrationTest extends TestCase
{
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test addone false
     */
    public function testGenerationField()
    {
        $field = Field::text('title', 'Title')->references('table_name', 'field_name', false);
        $codeField = app(Migration::class)->generationField($field);
        $this->assertTrue(is_string($codeField));
    }
}
