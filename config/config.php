<?php
// GarbuzIvan\LaravelGeneratorPackage

use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;

return [
    [
        "name" => "Name package",
        "description" => "Description package",
        "vendor" => "ivangarbuz",
        "package" => "test",
        "generator" => [
            "api" => true,
            "laravel-admin" => true,
            "routes" => true,
            "tests" => true,
            "factories" => true,
        ],
        "fields" => [
            [
                "name" => Field::text("Title"),
            ],
        ]
    ]
];
