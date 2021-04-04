<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Builder;

use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;

class Package
{
    private array $packageArr;
    /**
     * @var string
     */
    private string $name = 'name new package';
    private string $description = 'Description new package';

    /**
     * @var string|null
     */
    private ?string $packageVendor = null;
    private ?string $packageName = null;

    /**
     * @var bool
     */
    private bool $generator_tests = true;
    private bool $generator_seed = true;
    private bool $generator_api = true;
    private bool $generator_api_frontend = true;
    private bool $generator_laravel_admin = true;

    /**
     * @var array
     */
    private array $fields = [];
    private array $form = [];
    private array $filter = [];

    /**
     * @param array $package
     * @return $this
     */
    public function init(array $package): self
    {
        $this->packageArr = $package;
        $this->setName();
        $this->setDescription();
        $this->setPackageVendor();
        $this->setPackageName();

        $this->setGeneratorTests();
        $this->setGeneratorSeed();
        $this->setGeneratorApi();
        $this->setGeneratorApiFrontend();
        $this->setGeneratorLaravelAdmin();

        $this->setFields();
        $this->setForm();
        $this->setFilter();

        return $this;
    }

    /**
     * @return $this
     */
    public function setName(): self
    {
        $this->name = $this->packageArr['name'] ?? $this->name;
        return $this;
    }

    /**
     * @return $this
     */
    public function setDescription(): self
    {
        $this->name = $this->packageArr['description'] ?? $this->description;
        return $this;
    }

    /**
     * @return $this
     */
    public function setPackageVendor(): self
    {
        $this->packageVendor = $this->packageArr['vendor'] ?? $this->packageVendor;
        return $this;
    }

    /**
     * @return $this
     */
    public function setPackageName(): self
    {
        $this->packageName = $this->packageArr['package'] ?? $this->packageName;
        return $this;
    }

    /**
     * @return $this
     */
    public function setGeneratorTests(): self
    {
        $this->generator_tests = $this->packageArr['generator']['tests'] ?? $this->generator_tests;
        return $this;
    }

    /**
     * @return $this
     */
    public function setGeneratorSeed(): self
    {
        $this->generator_seed = $this->packageArr['generator']['seed'] ?? $this->generator_seed;
        return $this;
    }

    /**
     * @return $this
     */
    public function setGeneratorApi(): self
    {
        $this->generator_api = $this->packageArr['generator']['api'] ?? $this->generator_api;
        return $this;
    }

    /**
     * @return $this
     */
    public function setGeneratorApiFrontend(): self
    {
        $this->generator_api_frontend = $this->packageArr['generator']['api_frontend'] ?? $this->generator_api_frontend;
        return $this;
    }

    /**
     * @return $this
     */
    public function setGeneratorLaravelAdmin(): self
    {
        $this->generator_laravel_admin = $this->packageArr['generator']['laravel_admin'] ?? $this->generator_laravel_admin;
        return $this;
    }

    /**
     * @return $this
     */
    public function setFields(): self
    {
        if (!is_array($this->packageArr['fields'])) {
            return $this;
        }
        foreach ($this->packageArr['fields'] as $fieldKey => $fieldParam) {
            $this->fields[$fieldKey] = Field::loadFieldFromArray($fieldKey, $fieldParam);
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function setForm(): self
    {
        $this->form = $this->packageArr['form'] ?? $this->form;
        return $this;
    }

    /**
     * @return $this
     */
    public function setFilter(): self
    {
        $this->filter = $this->packageArr['filter'] ?? $this->filter;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescripton(): string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getPackageVendor(): ?string
    {
        return $this->packageVendor;
    }

    /**
     * @return string|null
     */
    public function getPackageName(): ?string
    {
        return $this->packageName;
    }

    /**
     * @return bool
     */
    public function getGeneratorTests(): bool
    {
        return $this->generator_tests;
    }

    /**
     * @return bool
     */
    public function getGeneratorSeed(): bool
    {
        return $this->generator_seed;
    }

    /**
     * @return bool
     */
    public function getGeneratorApi(): bool
    {
        return $this->generator_api;
    }

    /**
     * @return bool
     */
    public function getGeneratorApiFrontend(): bool
    {
        return $this->generator_api_frontend;
    }

    /**
     * @return bool
     */
    public function getGeneratorLaravelAdmin(): bool
    {
        return $this->generator_laravel_admin;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getForm(): array
    {
        return $this->form;
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return $this->filter;
    }
}
