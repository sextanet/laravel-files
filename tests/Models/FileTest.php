<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('local');
    Storage::fake('public');

    $this->model = fake_model();

    $this->file = $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg')
    );
});

it('can get the path', function () {
    expect($this->file->path())
        ->toBe(Storage::disk('local')->path($this->file->path));
});

it('can get the url', function () {
    expect($this->file->url())
        ->toBe(Storage::disk('local')->url($this->file->path));
});

it('can get the temporary url with specific minutes', function () {
    expect($this->file->temporaryUrl(20))
        ->toBe(Storage::disk('local')->temporaryUrl($this->file->path, now()->addMinutes(20)));
});

it('can get the temporary url with default minutes', function () {
    expect($this->file->temporaryUrl())
        ->toBe(Storage::disk('local')->temporaryUrl($this->file->path, now()->addMinutes(5)));
});

it('can get the temporary url with default forced minutes', function () {
    config(['files.temporary_url_minutes' => 10]);

    expect($this->file->temporaryUrl())
        ->toBe(Storage::disk('local')->temporaryUrl($this->file->path, now()->addMinutes(10)));
});

describe('generate names', function () {
    test('can generate name without extension', function () {
        expect($this->file->generateNameWithoutExtension('photo.jpg'))
            ->toBe('photo');
    });

    test('can generate extension', function () {
        expect($this->file->generateExtension('photo.jpg'))
            ->toBe('jpg');
    });

    test('can generate name with extension', function () {
        expect($this->file->generateNameWithExtension('photo.jpg'))
            ->toBe('photo.jpg');
    });
});

describe('download preserving extension', function () {
    test('without a name', function () {
        $response = $this->file->download(preserveExtension: true);

        $name = $this->file->path;

        expect($response->headers->get('content-disposition'))
            ->toContain("attachment; filename={$name}.jpg");
    });

    test('with a name', function () {
        $response = $this->file->download('name', preserveExtension: true);

        expect($response->headers->get('content-disposition'))
            ->toContain('attachment; filename=name.jpg');
    });
});
