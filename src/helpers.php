<?php

if (! function_exists('remove_extension')) {
    function remove_extension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }
}

if (! function_exists('get_extension')) {
    function get_extension(string $filename): string
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }
}
