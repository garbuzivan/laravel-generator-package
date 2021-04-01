<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form\Fields;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Configuration;
use GarbuzIvan\LaravelGeneratorPackage\Contracts\FieldInterface;

class TextField extends FieldAbstract
{
    protected Configuration $config;

    /**
     * constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * TextField init.
     * @param array $arguments
     * @throws Exception
     */
    public function init(array $arguments): FieldInterface
    {
        parent::init($arguments);
        $this->setType('string');
        $this->setLight(255);
        return $this;
    }
}
