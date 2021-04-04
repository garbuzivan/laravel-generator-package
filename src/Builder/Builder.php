<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Builder;

use GarbuzIvan\LaravelGeneratorPackage\Configuration;

class Builder
{
    /**
     * @var Configuration
     */
    private Configuration $config;

    /**
     * @var string|null
     */
    private ?string $packageVendor = null;
    private ?string $packageName = null;

    /**
     * Builder constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @param string|null $packageFilter
     * @return bool
     */
    public function init(?string $packageFilter = null): bool
    {
        $this->initFilter($packageFilter);
        $configGenerator = $this->config->getGenerator();
        foreach ($configGenerator as $package) {
            $package = app(Package::class)->init($package);
            if ($this->isIgnore($package->getPackageVendor(), $package->getPackageName())) {
                continue;
            }
            /* Generation */

        }
        return true;
    }

    /**
     * @param string $vandor
     * @param string $name
     * @return bool
     */
    public function isIgnore(string $vandor, string $name): bool
    {
        if (!is_null($this->getPackageVendor()) && $this->getPackageVendor() != $vandor) {
            return true;
        }
        if (!is_null($this->getPackageName()) && $this->getPackageName() != $name) {
            return true;
        }
        return false;
    }

    /**
     * @param string|null $package
     * @return bool
     */
    public function initFilter(?string $package = null): bool
    {
        if (is_null($package)) {
            return true;
        }
        $package = mb_strtolower($package);
        $package = str_replace('\\', '/', $package);
        if (!mb_stripos($package, '/')) {
            $this->packageVendor = $package;
            return true;
        }
        $match = explode('/', $package, 2);
        $this->packageVendor = $match[0];
        $this->packageName = mb_strlen(trim($match[1])) > 0 ? $match[1] : null;
        return true;
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
}
