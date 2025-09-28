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

if (! function_exists('file_name_with_extension')) {
    function file_name_with_extension(string $filename): string
    {
        return file_remove_extension($filename).'.'.file_get_extension($filename);
    }
}
