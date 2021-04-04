<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

use Exception;
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
     * @return bool|string
     */
    public function findFieldClass(string $method)
    {
        if (mb_strlen(trim($method)) == 0) {
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

    /**
     * @param string $column
     * @param array $config
     * @return FieldInterface
     * @throws Exception
     */
    public function loadFieldFromArray(string $column, array $config): FieldInterface
    {
        $className = $this->findFieldClass($config['field']);
        if (!$className) {
            throw new Exception('Field ' . $column . ':' . $config['field'] . ' not found and not available for use');
        }
        $field = app($className)->init([$column, $config['label']]);
        if (isset($config['placeholder'])) {
            $field->setPlaceholder($config['placeholder']);
        }
        if (isset($config['default'])) {
            $field->default($config['default']);
        }
        if (isset($config['index'])) {
            $field->index($config['index']);
        }
        if (isset($config['fillable'])) {
            $field->fillable($config['fillable']);
        }
        if (isset($config['hidden'])) {
            $field->hidden($config['hidden']);
        }
        if (isset($config['references']['table']) && isset($config['references']['field'])) {
            $field->references($config['references']['table'], $config['references']['field']);
        }
        if (isset($config['filter']['type'])) {
            $field->setType($config['filter']['type']);
        }
        if (isset($config['filter']['light'])) {
            $field->setLight($config['filter']['light']);
        }
        if (isset($config['filter']['light'])) {
            $field->setLight($config['filter']['light']);
        }
        if (isset($config['filter']['nullable'])) {
            $field->nullable($config['filter']['nullable']);
        }
        if (isset($config['filter']['unique'])) {
            $field->nullable($config['filter']['unique']);
        }
        if (isset($config['filter']['required'])) {
            $field->required($config['filter']['required']);
        }
        if (isset($config['filter']['max'])) {
            $field->max($config['filter']['max']);
        }
        if (isset($config['filter']['min'])) {
            $field->min($config['filter']['min']);
        }
        if (isset($config['filter']['mask'])) {
            $field->setMask($config['filter']['mask']);
        }
        return $field;
    }
}
