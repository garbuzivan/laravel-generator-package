<?php
// GarbuzIvan\LaravelGeneratorPackage

use GarbuzIvan\LaravelGeneratorPackage\Form\Fields\TextField;

return [
    'fields' => [
        'text' => TextField::class,
    ],
    'generator' => [
        /*
         * Package garbuzivan/test
         */
        [
            'name' => 'Name package',
            'description' => 'Description package',
            'vendor' => 'garbuzivan',
            'package' => 'test',
            'generator' => [
                'tests' => true,
                'factories' => true,
                'api' => true,
                'api-frontend' => true,
                'laravel-admin' => true,
            ],
            'fields' => [
                'title' => [
                    'label' => 'Title',
                    'placeholder' => 'Enter label',
                    'default' => null,
                    'index' => false,
                    'fillable' => true,
                    'hidden' => false,
                    'references' => null,
                    'filter' => [
                        'required' => true,
                        'nullable' => true,
                        'unique' => false,
                        'type' => "string",
                        'light' => 255,
                        'max' => null,
                        'min' => null,
                        'mask' => null,
                    ],
                    'saving' => null,
                    'saved' => null,
                    'view' => null,
                    'viewGrid' => null,
                ]
            ],
            'form' => [
                [
                    'title',
                ],
            ],
            'filter' => [
                [
                    'title',
                ],
            ]
        ]
    ]
];
