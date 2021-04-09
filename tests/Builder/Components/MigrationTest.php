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
     * Test Generation Field
     */
    public function testGenerationField()
    {
        $field = Field::text('title', 'Title')->references('App\Models\User::class', 'table_name', 'field_name', 'hasOne');
        $codeFunction = app(Migration::class)->generationField($field);
        $this->assertTrue(is_string($codeFunction));
    }
}
