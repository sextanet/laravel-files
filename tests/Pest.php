<?php

use SextaNet\LaravelFiles\Models\YourModel;
use SextaNet\LaravelFiles\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function fake_model()
{
    $model = YourModel::factory()->create();

    return $model;
}
