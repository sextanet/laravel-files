<?php

namespace SextaNet\LaravelFiles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use SextaNet\LaravelFiles\HasFiles;

class YourModel extends Model
{
    use HasFactory;
    use HasFiles;
}
