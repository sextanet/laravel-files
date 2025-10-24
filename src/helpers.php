<?php

use Illuminate\Http\UploadedFile;
use SextaNet\LaravelFiles\Facades\LaravelFiles;

if (! function_exists('laravel_files_remove_extension')) {
    function laravel_files_remove_extension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }
}

if (! function_exists('laravel_files_get_extension')) {
    function laravel_files_get_extension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }
}

if (! function_exists('laravel_files_format_name_with_extension')) {
    function laravel_files_format_name_with_extension(string $filename): string
    {
        return laravel_files_remove_extension($filename).'.'.laravel_files_get_extension($filename);
    }
}

if (! function_exists('laravel_files_override_name_but_preserve_extension')) {
    function laravel_files_override_name_but_preserve_extension(string $original_name, ?string $new_name): string
    {
        if (! $new_name) {
            return laravel_files_format_name_with_extension($original_name);
        }

        $extension = laravel_files_get_extension($original_name);

        return $new_name.($extension ? '.'.$extension : '');
    }
}

if (! function_exists('laravel_files_generate_destination_path')) {
    function laravel_files_generate_destination_path($destination = null): string
    {
        return $destination ?? '';
    }
}

if (! function_exists('laravel_files_generate_name')) {
    function laravel_files_generate_name(UploadedFile $file, ?string $name = null): string
    {
        if (is_null($name) && ! LaravelFiles::getPreserveOriginalNames()) {
            $name = uniqid().str()->random(4);
        }

        $name = $name ?? laravel_files_remove_extension($file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();

        return laravel_files_format_name_with_extension($name.'.'.$extension);
    }
}
