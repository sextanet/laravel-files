<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SextaNet\LaravelFiles\Models\YourModel;

beforeEach(function () {
    Storage::fake('local');
    Storage::fake('public');

    $this->model = fake_model();

    $this->file = $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg')
    );
});

it('has owner', function () {
    expect($this->file->owner)
        ->toBeInstanceOf(YourModel::class);
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

describe('download preserving extension', function () {
    test('without a name', function () {
        $response = $this->file->download(preserveExtension: true);

        $name = laravel_files_remove_extension($this->file->path);

        expect($response->headers->get('content-disposition'))
            ->toContain("attachment; filename={$name}.jpg");
    });

    test('with a name', function () {
        $response = $this->file->download('name', preserveExtension: true);

        expect($response->headers->get('content-disposition'))
            ->toContain('attachment; filename=name.jpg');
    });
});

describe('download without preserving extension', function () {
    test('without a name', function () {
        $response = $this->file->download(preserveExtension: false);

        $name = laravel_files_remove_extension($this->file->path);

        expect($response->headers->get('content-disposition'))
            ->toContain("attachment; filename={$name}");
    });

    test('with a name', function () {
        $response = $this->file->download('name', preserveExtension: false);

        expect($response->headers->get('content-disposition'))
            ->toContain('attachment; filename=name');
    });
});
