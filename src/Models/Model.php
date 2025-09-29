<?php

namespace SextaNet\LaravelFiles\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    protected $guarded = [];
}
