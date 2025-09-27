<?php

namespace SextaNet\LaravelFiles\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;

class File extends Model
{
    use HasUlids;

    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('files.table', 'files');
    }
}
