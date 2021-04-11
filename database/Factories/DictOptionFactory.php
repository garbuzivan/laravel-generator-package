<?php

declare(strict_types=1);

namespace Database\Factories\GarbuzIvan\LaravelGeneratorPackage\Models;

use GarbuzIvan\LaravelGeneratorPackage\Models\Dict;
use GarbuzIvan\LaravelGeneratorPackage\Models\DictOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class DictOptionFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DictOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->slug,
            'json' => null,
            'dict_id' => Dict::factory(),
        ];
    }
}
