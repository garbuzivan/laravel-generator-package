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
     * @param string|null $package
     * @return bool
     */
    public function init(?string $package = null): bool
    {
        $this->initFilter($package);
        $configGenerator = $this->config->getGenerator();
        foreach ($configGenerator as $package) {
            if ($this->isIgnore($package['vendor'], $package['package'])) {
                continue;
            }
            /* Generation */
            var_dump($this->packageVendor, $this->packageName);
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
        if ($this->getPackageVendor() != null && $this->getPackageVendor() != $vandor) {
            return true;
        }
        if ($this->getPackageName() != null && $this->getPackageName() != $name) {
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
