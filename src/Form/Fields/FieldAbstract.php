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
    protected $default = null;

    /**
     * @var Filter
     */
    protected Filter $filter;

    /**
     * @var bool
     */
    protected bool $index = false;
    protected bool $fillable = true;
    protected bool $hidden = false;

    /**
     * @var array|null
     */
    protected ?array $references = null;

    /**
     * @var Closure
     */
    protected Closure $saving;
    protected Closure $saved;
    protected Closure $view;
    protected Closure $viewGrid;

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
        // default save Closure
        $this->saved = $this->saving = function(Form $data) {
            return $data;
        };
        // default view Closure
        $this->view = $this->viewGrid = function(string $column, Form $data) {
            return $data->$column;
        };
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
     * Method called before saving data
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setSaving(Closure $closure): FieldInterface
    {
        $this->saving = $closure;
        return $this;
    }

    /**
     * Method called after saving data
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setSaved(Closure $closure): FieldInterface
    {
        $this->saved = $closure;
        return $this;
    }

    /**
     * The method called to convert data from the database for display
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setView(Closure $closure): FieldInterface
    {
        $this->view = $closure;
        return $this;
    }

    /**
     * The method called to convert data from the database for display in grid
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setViewGrid(Closure $closure): FieldInterface
    {
        $this->viewGrid = $closure;
        return $this;
    }

    /**
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true): FieldInterface
    {
        $this->filter->required($required);
        return $this;
    }

    /**
     * @param int|null $light
     * @return $this
     */
    public function max(?int $light = null): FieldInterface
    {
        $this->filter->max($light);
        return $this;
    }

    /**
     * @param int|null $light
     * @return $this
     */
    public function min(?int $light = null): FieldInterface
    {
        $this->filter->min($light);
        return $this;
    }

    public function default($value): FieldInterface
    {
        $this->default = $value;
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
     * @param bool $fillable
     * @return FieldInterface
     */
    public function fillable(bool $fillable = true): FieldInterface
    {
        $this->fillable = $fillable;
        return $this;
    }

    /**
     * @param bool $hidden
     * @return FieldInterface
     */
    public function hidden(bool $hidden = true): FieldInterface
    {
        $this->hidden = $hidden;
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
     * @return string|null
     */
    public function getValueDefault(): mixed
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function getFillable(): bool
    {
        return $this->fillable;
    }

    /**
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->fillable;
    }

    /**
     * @return bool
     */
    public function getRequired(): bool
    {
        return $this->filter->getRequired();
    }

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->filter->getMax();
    }

    /**
     * @return int|null
     */
    public function getMin(): ?int
    {
        return $this->filter->getMin();
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
        return $this->saving;
    }

    /**
     * Method called after saving data
     * @return Closure
     */
    public function saved(): Closure
    {
        return $this->saved;
    }

    /**
     * The method called to convert data from the database for display
     * @return Closure
     */
    public function view(): Closure
    {
        return $this->view;
    }

    /**
     * The method called to convert data from the database for display in grid
     * @return Closure
     */
    public function viewGrid(): Closure
    {
        return $this->viewGrid;
    }

}
