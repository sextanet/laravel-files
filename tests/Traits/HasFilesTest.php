<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');

    $this->model = new class extends \Illuminate\Database\Eloquent\Model
    {
        use \SextaNet\LaravelFiles\Traits\HasFiles;
    };
});

it('has many files', function () {
    $this->assertInstanceOf(
        \Illuminate\Database\Eloquent\Relations\MorphMany::class,
        $this->model->files()
    );
});

test('can add a file', function () {
    $this->model->addFile(
        UploadedFile::fake()->image('photo.jpg'),
        'public'
    );
});
