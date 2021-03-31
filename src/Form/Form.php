<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Form;

use Illuminate\Support\Collection;

class Form
{
    protected Collection $data;

    public function __construct($data = null)
    {
        if ($data instanceof Collection) {
            $this->data = $data;
        }
        $this->data = collect($data);
    }
}
