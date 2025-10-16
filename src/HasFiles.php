<?php

namespace SextaNet\LaravelFiles;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use SextaNet\LaravelFiles\Facades\LaravelFiles;
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

    public function generateName(UploadedFile $file, ?string $name = null): string
    {
        $name = $name ?? $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        return format_name_with_extension($name.'.'.$extension);
    }

    public function storeUploadedFile(UploadedFile $file, ?string $destination = null, ?string $name = null)
    {
        $name_with_extension = $this->generateName($file, $name);

        return $file->storeAs(
            path: generate_destination_path($destination),
            name: $name_with_extension,
            options: [
                'disk' => LaravelFiles::getDisk(),
            ]
        );
    }

    public function addFile(UploadedFile $file, ?string $destination = null, ?string $name = null, ?string $type = null)
    {
        $name = $name ?? $file->getClientOriginalName();

        $uploaded_file = $this->storeUploadedFile($file, $destination, $name);

        return $this->files()->create([
            'disk' => LaravelFiles::getDisk(),
            'path' => $uploaded_file,
            'type' => $type,
        ]);
    }
}
