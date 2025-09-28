<?php

use SextaNet\LaravelFiles\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function fake_model()
{
    $model = new class extends \Illuminate\Database\Eloquent\Model
    {
        use \SextaNet\LaravelFiles\Traits\HasFiles;
    };

    $model->id = 1;

    return $model;
}
