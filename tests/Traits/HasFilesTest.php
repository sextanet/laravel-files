<?php

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SextaNet\LaravelFiles\Models\File;

beforeEach(function () {
    Storage::fake('public');

    $this->model = fake_model();
});

it('has many files', function () {
    $this->assertInstanceOf(
        MorphMany::class,
        $this->model->files()
    );
});

test('can add a file', function () {
    $file = $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg'),
        'public'
    );

    expect($file)
        ->toBeInstanceOf(File::class);
});
