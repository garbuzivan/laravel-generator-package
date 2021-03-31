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
    protected array $availableFields = [
        'text' => Fields\TextField::class,
    ];

    /**
     * Form field alias.
     *
     * @var array
     */
    protected array $fieldAlias = [];

    /**
     * Find field class.
     *
     * @param string $method
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
     * @param $args
     * @return FieldInterface
     * @throws FieldDoesNotExistsException
     */
    public function __call(string $method, $args): FieldInterface
    {
        if ($className = $this->findFieldClass($method)) {
            return app($className, $args);
        }
        throw new FieldDoesNotExistsException();
    }

    /**
     * @return array|string[]
     */
    public function getFields(): array
    {
        return $this->availableFields;
    }
}
