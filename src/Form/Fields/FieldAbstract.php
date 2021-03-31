<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form\Fields;

use Closure;
use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Contracts\FieldInterface;
use GarbuzIvan\LaravelGeneratorPackage\Form\Filter;
use GarbuzIvan\LaravelGeneratorPackage\Form\Form;

abstract class FieldAbstract implements FieldInterface
{
    /**
     * @var string
     */
    protected string $column;
    protected string $label = '';
    protected ?string $placeholder = null;

    /**
     * @var Filter
     */
    protected Filter $filter;

    /**
     * @var bool
     */
    protected bool $index = false;

    protected ?array $references = null;

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
        $this->filter = new Filter();
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
     * @param string $type
     * @return FieldInterface
     */
    public function setType(string $type): FieldInterface
    {
        $this->filter->setType($type);
        return $this;
    }

    /**
     * @param int $light
     * @return FieldInterface
     */
    public function setLight(int $light): FieldInterface
    {
        $this->filter->setLight($light);
        return $this;
    }

    /**
     * @param string|null $mask
     * @return FieldInterface
     */
    public function setMask(?string $mask = null): FieldInterface
    {
        $this->filter->setMask($mask);
        return $this;
    }

    /**
     * @param string|null $placeholder
     * @return FieldInterface
     */
    public function setPlaceholder(?string $placeholder = null): FieldInterface
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @param string|null $table
     * @param string|null $field
     * @param bool $hasMany
     * @return FieldInterface
     * @throws Exception
     */
    public function references(?string $table = null, ?string $field = null, bool $hasMany = true): FieldInterface
    {
        if ((!is_string($table) && !is_null($table)) || (!is_string($field) && !is_null($field))) {
            throw new Exception('References should be a string or null');
        }
        if (
            is_null($table)
            || is_null($field)
            || mb_strlen($table) == 0
            || mb_strlen($field) == 0
        ) {
            $this->references = null;
        }
        $this->references = ['table' => $table, 'field' => $field, 'hasmany' => $hasMany];
        return $this;
    }

    /**
     * @param bool $index
     * @return FieldInterface
     */
    public function index(bool $index = true): FieldInterface
    {
        $this->index = $index;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->filter->getType();
    }

    /**
     * @return int
     */
    public function getLight(): int
    {
        return $this->filter->getLight();
    }

    /**
     * @return string|null
     */
    public function getMask(): ?string
    {
        return $this->filter->getMask();
    }

    /**
     * @return string|null
     */
    public function getReferencesTable(): ?string
    {
        return $this->references['table'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getReferencesField(): ?string
    {
        return $this->references['field'] ?? null;
    }

    /**
     * @return bool
     */
    public function getReferencesMany(): bool
    {
        return $this->references['hasmany'] ?? true;
    }

    /**
     * @return string|null
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * @return bool
     */
    public function isIndex(): bool
    {
        return $this->index;
    }

    /**
     * Method called before saving data
     * @return Closure
     */
    public function saving(): Closure
    {
        return function(Form $data)
        {
            return $data;
        };
    }

    /**
     * Method called after saving data
     * @return Closure
     */
    public function saved(): Closure
    {
        return function(Form $data)
        {
            return $data;
        };
    }

    /**
     * The method called to convert data from the database for display
     * @return Closure
     */
    public function view(): Closure
    {
        return function(Form $data)
        {
            return $data;
        };
    }
}
