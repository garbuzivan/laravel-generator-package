<?php
// GarbuzIvan\LaravelGeneratorPackage

use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;

return [
    [
        "name" => "Name package",
        "description" => "Description package",
        "vendor" => "garbuzivan",
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
                Field::text('title', 'Title'),
            ],
            [
                Field::text('keywords', 'Keywords'),
                Field::text('description', 'description'),
            ],
            [
                Field::text('text', 'Text'),
            ],
        ],
        "filters" => [
            [
                'title',
            ],
            [
                'keywords',
                'description',
            ],
            [
                'text',
            ],
        ]
    ]
];
