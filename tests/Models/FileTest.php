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
