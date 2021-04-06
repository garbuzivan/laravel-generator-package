<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Builder;

use GarbuzIvan\LaravelGeneratorPackage\Builder\Components\Migration;
use GarbuzIvan\LaravelGeneratorPackage\Configuration;
use Illuminate\Support\Facades\File;

class FileGenerator
{
    /**
     * @var Configuration
     */
    private Configuration $config;

    /**
     * @var Package
     */
    private Package $package;

    /**
     * FileGenerator constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @param Package $package
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function make(Package $package): bool
    {
        $this->package = $package;
        $this->templates();
        app(Migration::class)->make($package);
        return true;
    }

    /**
     * Copy all templates file
     *
     * @return bool
     */
    public function templates(): bool
    {
        $templatesDir = realpath(__DIR__ . '/../../templates');
        $files = File::allFiles($templatesDir, true);
        foreach ($files as $file) {
            $pathDir = str_replace($templatesDir, '', $file->getPath());
            $pathDir = $this->package->getPath($pathDir);
            if (!file_exists($pathDir)) {
                continue;
            }
            $content = $this->replacement(file_get_contents($file->getRealPath()));
            $newPathFile = str_replace([$templatesDir, '.stub'], '', $file->getRealPath());
            $newPathFile = $this->package->getPath($newPathFile);
            file_put_contents($newPathFile, $content);
        }
        return true;
    }

    /**
     * @param string|null $content
     * @return string|null
     */
    public function replacement(?string $content = null): ?string
    {
        $content = str_replace([
            '%PACKAGE_GIT%',
            '%PACKAGE_PVENDOR%',
            '%PACKAGE_PNAME%',
            '%PACKAGE_NAMESPACE%',
            '%PACKAGE_NAMESPACE_SLASHES%',
            '%PACKAGE_CONFIG_NAME%',
            '%PACKAGE_NAME%',
            '%PACKAGE_DESCRIPTIONS%',
        ], [
            $this->package->getPackageVendor() . '/' . $this->package->getPackageName(),
            $this->package->getPackageVendor(),
            $this->package->getPackageName(),
            $this->spacer(/** @scrutinizer ignore-type */ $this->package->getPackageVendor()) . '\\' . $this->spacer(/** @scrutinizer ignore-type */ $this->package->getPackageName()),
            $this->spacer(/** @scrutinizer ignore-type */ $this->package->getPackageVendor()) . '\\\\' . $this->spacer(/** @scrutinizer ignore-type */ $this->package->getPackageName()),
            $this->package->getPackageVendor() . '-' . $this->package->getPackageName(),
            $this->package->getName(),
            $this->package->getDescripton(),
        ], $content);
        return $content;
    }

    /**
     * @param string $name
     * @return string
     */
    public function spacer(string $name): string
    {
        $name = preg_replace('~[^a-z0-9]~isuU', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }
}
