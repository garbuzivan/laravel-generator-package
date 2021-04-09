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
    protected ?string $cast = null;
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
     * FieldAbstract init.
     * @param array $arguments
     * @return FieldInterface
     * @throws Exception
     */
    public function init(array $arguments): FieldInterface
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
        $this->filter = app(Filter::class);
        // default save Closure
        $this->saved = $this->saving = function(Form $data) {
            return $data;
        };
        // default view Closure
        $this->view = $this->viewGrid = function(string $column, Form $data) {
            return $data->$column;
        };
        return $this;
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
     * @param string $cast
     * @return FieldInterface
     */
    public function setCast(string $cast): FieldInterface
    {
        $this->cast = $cast;
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

    /**
     * @param mixed|null $value
     * @return FieldInterface
     */
    public function default($value = null): FieldInterface
    {
        $this->default = $value;
        return $this;
    }

    /**
     * @param string $model
     * @param string $table
     * @param string $field
     * @param string $has
     * @return FieldInterface
     * @throws Exception
     */
    public function references(string $model, string $table, string $field, string $has = 'hasMany'): FieldInterface
    {
        if (mb_strlen(trim($table)) == 0 || mb_strlen(trim($field)) == 0) {
            throw new Exception('References should be a string and not null');
        }
        $this->references = ['model' => $model, 'table' => $table, 'field' => $field, 'has' => $has];
        return $this;
    }

    /**
     * @return FieldInterface
     */
    public function referencesDisabled(): FieldInterface
    {
        $this->references = null;
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
     * @param bool $nullable
     * @return FieldInterface
     */
    public function nullable(bool $nullable = true): FieldInterface
    {
        $this->filter->nullable($nullable);
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
     * @param bool $unique
     * @return FieldInterface
     */
    public function unique(bool $unique = true): FieldInterface
    {
        $this->filter->unique($unique);
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
     * @return string|null
     */
    public function getCast(): ?string
    {
        return $this->cast;
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
    public function getReferencesModel(): ?string
    {
        return $this->references['model'] ?? null;
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
     * @return string
     */
    public function getReferencesHas(): string
    {
        return $this->references['has'];
    }

    /**
     * @return string|null
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * @return mixed
     */
    public function getDefault()
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
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
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

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->filter->getNullable();
    }

    /**
     * @return bool
     */
    public function isUnique(): bool
    {
        return $this->filter->getUnique();
    }
}
