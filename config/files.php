<?php

return [
    'table' => env('FILES_TABLE', 'files'),

    'disk' => env('FILES_DISK', env('FILESYSTEM_DISK', 'local')),

    'temporary_url_minutes' => env('FILES_TEMPORARY_URL_MINUTES', 5),
];
