<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests;

use GarbuzIvan\LaravelGeneratorPackage\Configuration;
use GarbuzIvan\LaravelGeneratorPackage\Form\Fields\TextField;

class ConfigurationTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
{
    public function testSetFields()
    {
        $config = app(Configuration::class);
        $config->setFields(['text' => TextField::class]);
        $fields = $config->getFields();
        $this->assertTrue(isset($fields['text']));
    }

    public function testSetField()
    {
        $config = app(Configuration::class);
        $config->setField('test', TextField::class);
        $fields = $config->getFields();
        $this->assertTrue(isset($fields['test']));
    }
}
