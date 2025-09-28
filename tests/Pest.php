<?php

use SextaNet\LaravelFiles\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function fake_model()
{
    return new SextaNet\LaravelFiles\Models\YourModel;
}
