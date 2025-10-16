<?php

namespace SextaNet\LaravelFiles;

class LaravelFiles
{
    public function setDisk(string $disk): void
    {
        config(['files.disk' => $disk]);
    }

    public function setTemporaryUrlMinutes(int $minutes): void
    {
        config(['files.temporary_url_minutes' => $minutes]);
    }

    public function setTable(string $table): void
    {
        config(['files.table' => $table]);
    }

    public function getDisk(): string
    {
        return config('files.disk');
    }

    public function preserveOriginalNames($enabled = true): void
    {
        config(['files.preserve_original_names' => $enabled]);
    }

    public function getPreserveOriginalNames(): bool
    {
        return config('files.preserve_original_names');
    }
}
