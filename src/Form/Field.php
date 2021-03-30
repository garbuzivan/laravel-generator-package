<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

use GarbuzIvan\LaravelGeneratorPackage\Contracts\FieldInterface;
use GarbuzIvan\LaravelGeneratorPackage\Exceptions\FieldDoesNotExistsException;

class Field
{
    /**
     * Available fields.
     *
     * @var array
     */
    public array $availableFields = [
        'text' => Fields\TextField::class,
    ];

    /**
     * Form field alias.
     *
     * @var array
     */
    public array $fieldAlias = [];

    /**
     * Find field class.
     *
     * @param string $class
     * @return bool|mixed
     */
    public function findFieldClass(string $method)
    {
        if (is_null($method)) {
            return false;
        }
        if (isset($this->fieldAlias[$method])) {
            $class = $this->fieldAlias[$method];
        }
        if (isset($this->availableFields[$method])) {
            $class = $this->availableFields[$method];
        }
        if (isset($class) && class_exists($class)) {
            return $class;
        }
        return false;
    }

    /**
     * Generate a Field object and add to form builder if Field exists.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return FieldInterface
     * @throws FieldDoesNotExistsException
     */
    public function __call(string $method, array $arguments = []): FieldInterface
    {
        if ($className = $this->findFieldClass($method)) {
            return app($className, $arguments);
        }
        throw new FieldDoesNotExistsException();
    }
}
