<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests;

class MakeCommandTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * Running a test for generating all packets
     */
    public function testMakeAll()
    {
        $this->artisan('lgp:make')->assertExitCode(1);
    }

    /**
     * Running a single batch test
     */
    public function testMakeOnePackage()
    {
        $this->artisan('lgp:make vendor/package-name')->assertExitCode(1);
    }
}

