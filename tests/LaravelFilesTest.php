<?php

use SextaNet\LaravelFiles\Facades\LaravelFiles;

it('can set disk', function () {
    LaravelFiles::setDisk('s3');

    expect(config('files.disk'))
        ->toBe('s3');
});

it('can set minutes', function () {
    LaravelFiles::setTemporaryUrlMinutes(60);

    expect(config('files.temporary_url_minutes'))
        ->toBe(60);
});
