<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form\Fields;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Form\FieldAbstract;

class TextField extends FieldAbstract
{
    /**
     * TextField constructor.
     * @param array $arguments
     * @throws Exception
     */
    public function __construct(array $arguments)
    {
        parent::__construct($arguments);
        $this->setType('string');
        $this->setLight(255);
    }
}
