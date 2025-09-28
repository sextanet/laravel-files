<?php

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SextaNet\LaravelFiles\Models\File;

beforeEach(function () {
    Storage::fake('local');
    Storage::fake('public');

    $this->model = fake_model();
});

it('has many files', function () {
    $this->assertInstanceOf(
        MorphMany::class,
        $this->model->files()
    );
});

test('add a file', function () {
    $file = $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg'),
        'public'
    );

    expect($file)
        ->toBeInstanceOf(File::class);
});

test('add a file with type field', function () {
    $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg'),
        type: 'image',
    );

    expect($this->model->files()->type('image')->count())
        ->toBe(1);

    expect($this->model->files()->type('another')->count())
        ->toBe(0);
});
