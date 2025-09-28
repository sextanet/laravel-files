<?php

namespace SextaNet\LaravelFiles\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasUlids;

    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('files.table', 'files');
    }

    public function getPath(): string
    {
        return Storage::disk($this->disk)->path($this->path);
    }

    public function getUrl(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function getTemporaryUrl(?int $minutes = 5): string
    {
        return Storage::disk($this->disk)
            ->temporaryUrl($this->path, now()->addMinutes($minutes));
    }
}
