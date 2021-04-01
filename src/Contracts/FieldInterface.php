<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Contracts;

use Closure;
use Exception;

interface FieldInterface
{
    /**
     * TextField init.
     * @param array $arguments
     * @throws Exception
     */
    public function init(array $arguments): FieldInterface;
}
