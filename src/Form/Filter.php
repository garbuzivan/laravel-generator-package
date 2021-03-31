<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

class Filter
{
    /**
     * @var bool
     */
    protected bool $required = true;
    protected bool $nullable = true;
    protected bool $unique = false;

    /**
     * @var string
     */
    protected string $type = 'string';

    /**
     * @var int
     */
    protected int $light = 255;
    protected ?int $max = null;
    protected ?int $min = null;

    /**
     * @var string|null
     */
    protected ?string $mask = null;

    /**
     * Filter constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param bool $nullable
     */
    public function nullable(bool $nullable = true): void
    {
        $this->nullable = $nullable;
    }

    /**
     *
     */
    public function unique(): void
    {
        $this->unique = true;
    }

    /**
     * @param string $type
     * @return Filter
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $light
     * @return Filter
     */
    public function setLight(int $light): self
    {
        $this->light = $light;
        return $this;
    }

    /**
     * @param string|null $mask
     * @return Filter
     */
    public function setMask(?string $mask = null): self
    {
        $this->mask = $mask;
        return $this;
    }

    /**
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true): self
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @param int|null $light
     * @return $this
     */
    public function max(?int $light = null): self
    {
        $this->max = $light;
        return $this;
    }

    /**
     * @param int|null $light
     * @return $this
     */
    public function min(?int $light = null): self
    {
        $this->min = $light;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getLight(): int
    {
        return $this->light;
    }

    /**
     * @return string|null
     */
    public function getMask(): ?string
    {
        return $this->mask;
    }

    /**
     * @return bool
     */
    public function getRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * @return int|null
     */
    public function getMin(): ?int
    {
        return $this->min;
    }
}
