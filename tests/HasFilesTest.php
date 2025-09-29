<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SextaNet\LaravelFiles\Models\File;

beforeEach(function () {
    Storage::fake('local');
    Storage::fake('public');

    $this->model = fake_model();
});

test('add a file', function () {
    $file = $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg')
    );

    expect($file)
        ->toBeInstanceOf(File::class);
});

test('add a file with a custom name', function () {
    $file = $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg'),
        'custom_name.jpg'
    );

    expect($file->name)
        ->toBe('custom_name.jpg');
});

test('add a file with a type', function () {
    $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg'),
        type: 'custom-type',
    );

    expect($this->model->files()->type('custom-type')->count())
        ->toBe(1);

    expect($this->model->files()->type('another')->count())
        ->toBe(0);
});

it('has many files', function () {
    $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg')
    );

    expect($this->model->files()->first())
        ->toBeInstanceOf(File::class);
});

it('has latest file', function () {
    $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg')
    );

    $this->assertInstanceOf(
        File::class,
        $this->model->latestFile
    );
});
