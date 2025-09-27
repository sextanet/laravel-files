<?php

beforeEach(function () {
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
