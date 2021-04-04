<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Builder;

use GarbuzIvan\LaravelGeneratorPackage\Builder\Package;
use GarbuzIvan\LaravelGeneratorPackage\Configuration;

class PackageTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{

    private Package $package;
    private Configuration $config;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->config = app(Configuration::class);
        $this->package = app(Package::class)->init($this->config->getGenerator()[0]);
    }

    /**
     * Test ignore generation
     */
    public function testInit()
    {
        $this->assertTrue(is_string($this->package->getPackageName()));
    }
}
