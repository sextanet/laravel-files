<?php

namespace SextaNet\LaravelFiles\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use SextaNet\LaravelFiles\Models\File;

trait HasFiles
{
    public function files(): MorphMany
    {
        return $this->morphMany(config('files.model', File::class), 'fileable');
    }
}
