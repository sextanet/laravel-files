<?php

namespace SextaNet\LaravelFiles;

class LaravelFiles {
    public function setDisk(string $disk): void
    {
        config(['files.disk' => $disk]);
    }

    public function setTable(string $table): void
    {
        config(['files.table' => $table]);
    }
}
