<?php

namespace SextaNet\LaravelFiles\Models;

class File extends \Illuminate\Database\Eloquent\Model
{
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('files.table', 'files');
    }
}
