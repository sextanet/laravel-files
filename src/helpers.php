<?php

if (! function_exists('file_remove_extension')) {
    function file_remove_extension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }
}

if (! function_exists('file_get_extension')) {
    function file_get_extension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }
}

if (! function_exists('format_name_with_extension')) {
    function format_name_with_extension(string $filename): string
    {
        return file_remove_extension($filename).'.'.file_get_extension($filename);
    }
}

if (! function_exists('file_override_name_but_preserve_extension')) {
    function file_override_name_but_preserve_extension(string $original_name, ?string $new_name): string
    {
        if (! $new_name) {
            return format_name_with_extension($original_name);
        }

        $extension = file_get_extension($original_name);

        return $new_name.($extension ? '.'.$extension : '');
    }
}

if (! function_exists('generate_destination_path')) {
    function generate_destination_path($destination = null): string
    {
        return $destination ?? '';
    }
}
