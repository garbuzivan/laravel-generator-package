<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Contracts\FieldInterface;
use GarbuzIvan\LaravelGeneratorPackage\Exceptions\FieldDoesNotExistsException;
use GarbuzIvan\LaravelGeneratorPackage\Form\Field;
use GarbuzIvan\LaravelGeneratorPackage\Form\Fields\TextField;

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
     * @throws FieldDoesNotExistsException
     * @throws Exception
     */
    public function register()
    {
        $this->app->bind(Field::class, function () {
            return new Field;
        });
        $fields = app(Field::class)->getFields();
        foreach ($fields as $field) {
            if (!$this->isFieldInterface($field)) {
                throw new FieldDoesNotExistsException();
            }
            $this->app->bind($field, function ($app, $arguments) {
                return new TextField($arguments);
            });
        }

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
