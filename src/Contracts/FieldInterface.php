<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Contracts;

use Closure;
use Exception;

interface FieldInterface
{
    /**
     * TextField init.
     * @param array $arguments
     * @return FieldInterface
     * @throws Exception
     */
    public function init(array $arguments): FieldInterface;

    /**
     * @param string $label
     * @return FieldInterface
     */
    public function setLabel(string $label = ''): FieldInterface;

    /**
     * @param string $type
     * @return FieldInterface
     */
    public function setType(string $type): FieldInterface;

    /**
     * @param int $light
     * @return FieldInterface
     */
    public function setLight(int $light): FieldInterface;

    /**
     * @param string|null $mask
     * @return FieldInterface
     */
    public function setMask(?string $mask = null): FieldInterface;

    /**
     * @param string|null $placeholder
     * @return FieldInterface
     */
    public function setPlaceholder(?string $placeholder = null): FieldInterface;

    /**
     * Method called before saving data
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setSaving(Closure $closure): FieldInterface;

    /**
     * Method called after saving data
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setSaved(Closure $closure): FieldInterface;

    /**
     * The method called to convert data from the database for display
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setView(Closure $closure): FieldInterface;

    /**
     * The method called to convert data from the database for display in grid
     * @param Closure $closure
     * @return FieldInterface
     */
    public function setViewGrid(Closure $closure): FieldInterface;

    /**
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true): FieldInterface;

    /**
     * @param int|null $light
     * @return $this
     */
    public function max(?int $light = null): FieldInterface;

    /**
     * @param int|null $light
     * @return $this
     */
    public function min(?int $light = null): FieldInterface;

    /**
     * @param null $value
     * @return FieldInterface
     */
    public function default($value = null): FieldInterface;

    /**
     * @param string $table
     * @param string $field
     * @param bool $hasMany
     * @return FieldInterface
     * @throws Exception
     */
    public function references(string $table, string $field, bool $hasMany = true): FieldInterface;

    /**
     * @return FieldInterface
     */
    public function referencesDisabled(): FieldInterface;

    /**
     * @param bool $index
     * @return FieldInterface
     */
    public function index(bool $index = true): FieldInterface;

    /**
     * @param bool $nullable
     * @return FieldInterface
     */
    public function nullable(bool $nullable = true): FieldInterface;

    /**
     * @param bool $fillable
     * @return FieldInterface
     */
    public function fillable(bool $fillable = true): FieldInterface;

    /**
     * @param bool $unique
     * @return FieldInterface
     */
    public function unique(bool $unique = true): FieldInterface;

    /**
     * @param bool $hidden
     * @return FieldInterface
     */
    public function hidden(bool $hidden = true): FieldInterface;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return string
     */
    public function getColumn(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return int
     */
    public function getLight(): int;

    /**
     * @return string|null
     */
    public function getMask(): ?string;

    /**
     * @return string|null
     */
    public function getReferencesTable(): ?string;

    /**
     * @return string|null
     */
    public function getReferencesField(): ?string;

    /**
     * @return bool
     */
    public function getReferencesMany(): bool;

    /**
     * @return string|null
     */
    public function getPlaceholder(): ?string;

    /**
     * @return mixed
     */
    public function getDefault();

    /**
     * @return bool
     */
    public function getFillable(): bool;

    /**
     * @return bool
     */
    public function getHidden(): bool;

    /**
     * @return bool
     */
    public function getRequired(): bool;

    /**
     * @return int|null
     */
    public function getMax(): ?int;

    /**
     * @return int|null
     */
    public function getMin(): ?int;

    /**
     * @return bool
     */
    public function isIndex(): bool;

    /**
     * Method called before saving data
     * @return Closure
     */
    public function saving(): Closure;

    /**
     * Method called after saving data
     * @return Closure
     */
    public function saved(): Closure;

    /**
     * The method called to convert data from the database for display
     * @return Closure
     */
    public function view(): Closure;

    /**
     * The method called to convert data from the database for display in grid
     * @return Closure
     */
    public function viewGrid(): Closure;

    /**
     * @return bool
     */
    public function getNullable(): bool;

    /**
     * @return bool
     */
    public function getUnique(): bool;
}
