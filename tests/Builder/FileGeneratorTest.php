<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Builder;

use GarbuzIvan\LaravelGeneratorPackage\Builder\FileGenerator;
use GarbuzIvan\LaravelGeneratorPackage\Builder\Package;
use GarbuzIvan\LaravelGeneratorPackage\Configuration;
use GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase;

class FileGeneratorTest extends TestCase
{

    private FileGenerator $fileGenerator;
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
        $this->fileGenerator = app(FileGenerator::class);
    }

    /**
     * Test addone false
     */
    public function testTemplates()
    {
        $this->package->setGeneratorApi(false);
        $this->package->setGeneratorSeed(false);
        $this->fileGenerator->make($this->package);
        $this->assertTrue($this->fileGenerator->templates());
    }
}

