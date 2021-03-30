<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Facades;

class Field extends \Illuminate\Support\Facades\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \GarbuzIvan\LaravelGeneratorPackage\Field::class;
    }
}
