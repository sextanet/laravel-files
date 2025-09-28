<?php

test('can remove the extension', function () {
    expect(remove_extension('file.jpg'))
        ->toBe('file');

    expect(remove_extension('file.name.jpg'))
        ->toBe('file.name');

    expect(remove_extension('file'))
        ->toBe('file');
})->only();

test('can get the extension', function () {
    expect(get_extension('file.jpg'))
        ->toBe('jpg');

    expect(get_extension('file.name.jpg'))
        ->toBe('jpg');

    expect(get_extension('file'))
        ->toBe('');
})->only();
