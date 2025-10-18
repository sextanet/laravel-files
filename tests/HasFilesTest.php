<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SextaNet\LaravelFiles\Facades\LaravelFiles;
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

describe('add file with parameters', function () {
    test('with destination', function () {
        LaravelFiles::preserveOriginalNames(true);

        $file = $this->model->addFile(
            UploadedFile::fake()->image('photo.jpg'),
            destination: 'documents/user',
        );

        expect($file->path)
            ->toBe('documents/user/photo.jpg');
    });

    test('with custom name', function () {
        $file = $this->model->addFile(
            UploadedFile::fake()->image('photo.jpg'),
            custom_name: 'file_name'
        );

        expect($file->custom_name)
            ->toBe('file_name');
    });

    test('with type', function () {
        $this->model->addFile(
            UploadedFile::fake()->image('photo.jpg'),
            type: 'custom-type',
        );

        expect($this->model->files()->type('custom-type')->count())
            ->toBe(1);

        expect($this->model->files()->type('another')->count())
            ->toBe(0);
    });
});
