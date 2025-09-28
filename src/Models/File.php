<?php

namespace SextaNet\LaravelFiles\Models;

use Illuminate\Contracts\Database\Query\Builder;
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
        return Storage::disk($this->attributes['disk'])
            ->path($this->attributes['path']);
    }

    public function url(): string
    {
        return Storage::disk($this->attributes['disk'])
            ->url($this->attributes['path']);
    }

    public function temporaryUrl(int $minutes = 0): string
    {
        if ($minutes === 0) {
            $minutes = config('files.temporary_url_minutes');
        }

        return Storage::disk($this->attributes['disk'])
            ->temporaryUrl($this->attributes['path'], now()->addMinutes($minutes));
    }

    public function download(?string $name = null, array $headers = [], $preserveExtension = true)
    {
        if ($preserveExtension) {
            $name = file_name_with_extension($name);
        }

        return Storage::disk($this->attributes['disk'])
            ->download($this->attributes['path'], $name, $headers);
    }

    public function scopeType(Builder $query, string $type)
    {
        return $query->where('type', $type);
    }
}
