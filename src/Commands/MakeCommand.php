<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class MakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lgp:make';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator the composer package from config file laravel-generator-package';

    /**
     * @var Composer
     */
    public Composer $composer;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @return mixed
     */
    public function handle()
    {
        return 0;
    }
}
