<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\DataBase\Seeders;

use GarbuzIvan\LaravelGeneratorPackage\Models\DictOption;
use Illuminate\Database\Seeder;
use GarbuzIvan\LaravelGeneratorPackage\Models\Dict;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $dict = Dict::create([
            'name' => 'Статус',
            'type' => 'select',
        ]);
        $create = [
            [
                'name' => 'Активно',
                'json' => null,
                'dict_id' => $dict->id,
            ],
            [
                'name' => 'Не активно',
                'json' => null,
                'dict_id' => $dict->id,
            ],
        ];
        DictOption::insert($create);
    }
}
