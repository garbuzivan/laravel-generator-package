<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

use GarbuzIvan\LaravelGeneratorPackage\Configuration;

class Form
{
    protected Configuration $config;

    /**
     * Form constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }
}
