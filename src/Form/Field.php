<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

use GarbuzIvan\LaravelGeneratorPackage\Configuration;
use GarbuzIvan\LaravelGeneratorPackage\Contracts\FieldInterface;
use GarbuzIvan\LaravelGeneratorPackage\Exceptions\FieldDoesNotExistsException;

class Field
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
        $fields = $this->config->getFields();
        if (isset($fields[$method])) {
            $class = $fields[$method];
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
    public function __call(string $method, array $args): FieldInterface
    {
        if ($className = $this->findFieldClass($method)) {
            /** @scrutinizer ignore-call */
            return app($className)->init($args);
        }
        throw new FieldDoesNotExistsException();
    }
}
