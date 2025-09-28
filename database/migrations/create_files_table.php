<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $table = config('files.table', 'laravel_files_table');

        Schema::create($table, function (Blueprint $table) {
            $table->ulid('id');
            $table->text('disk');
            $table->string('name');
            $table->text('path');
            $table->ulidMorphs('fileable');
            $table->string('type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
