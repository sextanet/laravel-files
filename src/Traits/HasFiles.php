<?php

namespace SextaNet\LaravelFiles\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;
use SextaNet\LaravelFiles\Models\File;

trait HasFiles
{
    public function files(): MorphMany
    {
        return $this->morphMany(config('files.model', File::class), 'fileable');
    }

    public function addFile(UploadedFile $file, ?string $name = null): File
    {
        $name = $name ?? $file->getClientOriginalName();

        $real_file = $file->store('', ['disk' => config('files.disk')]);

        return $this->files()->create([
            'disk' => config('files.disk'),
            'name' => $name,
            'path' => $real_file,
        ]);
    }
}
