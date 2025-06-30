<?php

namespace App\Http\Repositories;

use App\Models\File;

interface FileRepositoryInterface
{
    /**
     * Store a file record in the database.
     *
     * @param array $data
     * @return \App\Models\File
     */
    public function createFile(array $data) : File;
}
