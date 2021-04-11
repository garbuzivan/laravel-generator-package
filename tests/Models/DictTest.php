<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Models;

use GarbuzIvan\LaravelGeneratorPackage\Models\Dict;
use Mockery;

class DictTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Dict
     */
    public function testDict()
    {
        $dict = Mockery::mock(Dict::class);
        $this->assertInstanceOf(Dict::class, $dict);
    }
}
