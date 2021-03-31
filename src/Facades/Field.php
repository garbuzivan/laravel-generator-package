<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Facades;

use GarbuzIvan\LaravelGeneratorPackage\Form\Fields\TextField;

/**
 * @method TextField           text($column, $label = '')
 */
class Field extends \Illuminate\Support\Facades\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \GarbuzIvan\LaravelGeneratorPackage\Form\Field::class;
    }
}
