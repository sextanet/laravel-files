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

    public function latestFile(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->latestOfMany();
    }

    public function generateName(UploadedFile $file, ?string $name = ''): string
    {
        $name = $name ?? $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        return $name.'.'.$extension;
    }

    public function generateDestination($destination = ''): string
    {
        return $destination;
    }

    public function storeUploadedFile(UploadedFile $file, string $destination = '', string $name = '')
    {
        $name_with_extension = $this->generateName($file, $name);

        return $file->storeAs(
            path: $this->generateDestination($destination),
            name: $name_with_extension,
            options: [
                'disk' => config('files.disk'),
            ]
        );
    }

    public function addFile(UploadedFile $file, string $destination = '', string $name = '', string $type = '')
    {
        $name = $name ?? $file->getClientOriginalName();

        $uploaded_file = $this->storeUploadedFile($file, $destination, $name);

        return $this->files()->create([
            'disk' => config('files.disk'),
            'path' => $uploaded_file,
            'type' => $type,
        ]);
    }
}
