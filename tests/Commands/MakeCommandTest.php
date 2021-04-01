<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests;

use GarbuzIvan\LaravelGeneratorPackage\Commands\MakeCommand;

class MakeCommandTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    public function testMake()
    {
        $command = new MakeCommand;
        $this->assertTrue($command->handle() == 0);
    }
}

