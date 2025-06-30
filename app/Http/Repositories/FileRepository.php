<?php

namespace App\Http\Repositories;

use App\Models\File;

class FileRepository implements FileRepositoryInterface
{    
    public function createFile(array $data) : File
    {
        return File::create([
            'name' => $data['name'],
            'mime_type' => $data['mime_type'],
            'path' => $data['path'],
            'size' => $data['size']
        ]);
    }
}