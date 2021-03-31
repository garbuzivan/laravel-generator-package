<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

class Filter
{
    /**
     * @var bool
     */
    protected bool $nullable = false;
    protected bool $unique = false;

    /**
     * @var string
     */
    protected string $type = 'string';

    /**
     * @var int
     */
    protected int $light = 255;

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
     *
     */
    public function nullable(): void
    {
        $this->nullable = true;
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
}
