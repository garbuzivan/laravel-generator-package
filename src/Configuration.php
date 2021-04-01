<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage;

use GarbuzIvan\LaravelGeneratorPackage\Form\Fields\TextField;

class Configuration
{
    /**
     * @var string
     */
    protected string $configFile = 'laravel-generator-package';

    /**
     * The array of class fields.
     *
     * @var array
     */
    protected array $fields = [
        'text' => TextField::class,
    ];

    /**
     * Конфиг генерации пакетов
     *
     * @var array
     */
    protected array $generator = [];

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        $this->load();
    }

    /**
     * @return $this|Configuration
     */
    public function load(): Configuration
    {
        $fields = config($this->configFile . '.fields');
        if (is_array($fields)) {
            $this->setFields($fields);
        }
        $generator = config($this->configFile . '.generator');
        if (is_array($generator)) {
            $this->generator = $generator;
        }
        return $this;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * @param string $name
     * @param string $field
     */
    public function setField(string $name, string $field): void
    {
        $this->fields[$name] = $field;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getGenerator(): array
    {
        return $this->generator;
    }
}
