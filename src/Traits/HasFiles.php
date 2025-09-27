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

    public function addFile(UploadedFile $file, string $disk = 'public'): File
    {
        return $this->files()->create([
            'disk' => $disk,
            'name' => $file->getClientOriginalName(),
            'path' => $file->storePublicly('', ['disk' => $disk]),
        ]);
    }
}
