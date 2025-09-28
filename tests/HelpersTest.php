<?php

test('can remove the extension', function () {
    expect(file_remove_extension('file.jpg'))
        ->toBe('file');

    expect(file_remove_extension('file.name.jpg'))
        ->toBe('file.name');

    expect(file_remove_extension('file'))
        ->toBe('file');
});

test('can get the extension', function () {
    expect(file_get_extension('file.jpg'))
        ->toBe('jpg');

    expect(file_get_extension('file.name.jpg'))
        ->toBe('jpg');

    expect(file_get_extension('file'))
        ->toBe('');
});

test('can get name with extension', function () {
    expect(file_name_with_extension('file.jpg'))
        ->toBe('file.jpg');

    expect(file_name_with_extension('file.name.jpg'))
        ->toBe('file.name.jpg');

    expect(file_get_extension('file'))
        ->toBe('');
});
