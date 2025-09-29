<?php

namespace SextaNet\LaravelFiles;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use SextaNet\LaravelFiles\Models\File;

trait HasFiles
{
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function latest_file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->latestOfMany();
    }

    public function generateName(UploadedFile $file, ?string $name = null): string
    {
        $name = $name ?? $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        return $name.'.'.$extension;
    }

    public function generatePath(): string
    {
        return '';
    }

    public function storeUploadedFile(UploadedFile $file, ?string $name = null)
    {
        $name_with_extension = $this->generateName($file, $name);

        return $file->store($this->generatePath(), [
            'disk' => config('files.disk'),
            'name' => $name_with_extension,
        ]);
    }

    public function addFile(UploadedFile $file, ?string $name = null, ?string $type = null)
    {
        $name = $name ?? $file->getClientOriginalName();

        $uploaded_file = $this->storeUploadedFile($file, $name);

        return $this->files()->create([
            'disk' => config('files.disk'),
            'name' => $name,
            'path' => $uploaded_file,
            'type' => $type,
        ]);
    }
}
