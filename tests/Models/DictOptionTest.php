<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Models;

use GarbuzIvan\LaravelGeneratorPackage\Models\DictOption;
use Mockery;

class DictOptionTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test DictOption
     */
    public function testDictOption()
    {
        $dict = Mockery::mock(DictOption::class);
        $this->assertInstanceOf(DictOption::class, $dict);
    }
}
