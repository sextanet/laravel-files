<?php

use SextaNet\LaravelFiles\Models\YourModel;
use SextaNet\LaravelFiles\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function fake_model()
{
    $model = new YourModel;

    $model->id = 1;

    return $model;
}
