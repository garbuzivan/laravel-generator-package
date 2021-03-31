<?php

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Contracts\FieldInterface;

abstract class FieldAbstract implements FieldInterface
{
    /**
     * @var string
     */
    protected string $column;

    /**
     * @var string
     */
    protected string $label = 'Label';

    /**
     * FieldAbstract constructor.
     * @param array $arguments
     * @throws Exception
     */
    public function __construct(array $arguments)
    {
        if (!isset($arguments[0]) || !is_string($arguments[0])) {
            throw new Exception('The first argument of the field initialization must be a string');
        }
        if (!preg_match('~^([a-z0-9_]+)$~isuU', $arguments[0])) {
            throw new Exception('The field mask column must be ([a-z0-9 _]+)');
        }
        $this->column = $arguments[0];
        if (isset($arguments[1]) && is_string($arguments[1])) {
            $this->setLabel($arguments[1]);
        }
    }

    /**
     * @param string $label
     * @return FieldInterface
     */
    public function setLabel(string $label = ''): FieldInterface
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return FieldInterface
     */
    public function getLabel(): FieldInterface
    {
        return $this;
    }

    /**
     * @return FieldInterface
     */
    public function getColumn(): string
    {
        return $this->column;
    }
}
