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

    public function path(): string
    {
        return Storage::disk($this->attributes['disk'])->path($this->attributes['path']);
    }

    public function url(): string
    {
        return Storage::disk($this->attributes['disk'])->url($this->attributes['path']);
    }

    public function temporaryUrl(int $minutes = 0): string
    {
        if ($minutes === 0) {
            $minutes = config('files.temporary_url_minutes');
        }

        return Storage::disk($this->attributes['disk'])
            ->temporaryUrl($this->attributes['path'], now()->addMinutes($minutes));
    }
}
