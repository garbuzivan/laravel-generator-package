<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Contracts\FieldInterface;
use GarbuzIvan\LaravelGeneratorPackage\Form\Field;
use GarbuzIvan\LaravelGeneratorPackage\Form\Form;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services...
     *
     * @return void
     */
    public function boot()
    {
        $configPath = $this->configPath();

        $this->publishes([
            $configPath . '/config.php' => $this->publishPath('laravel-generator-package.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     * @throws Exception
     */
    public function register()
    {
        $this->app->singleton(Configuration::class, function($app) {
            return new Configuration;
        });
        $this->app->bind(Field::class, function($app) {
            return new Field(app(Configuration::class));
        });
        $this->app->bind(Form::class, function($app) {
            return new Form(app(Configuration::class));
        });
    }

    /**
     * @return string
     */
    protected function configPath(): string
    {
        return __DIR__ . '/../config';
    }

    /**
     * @param $configFile
     * @return string
     */
    protected function publishPath($configFile): string
    {
        if (function_exists('config_path')) {
            return config_path($configFile);
        } else {
            return base_path('config/' . $configFile);
        }
    }

    /**
     * @param string $class
     * @return bool
     */
    public function isFieldInterface(string $class): bool
    {
        $implements = class_implements($class);
        return isset($implements[FieldInterface::class]);
    }
}
