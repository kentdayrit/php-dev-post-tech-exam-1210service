<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FileService
{   
    /**
     * Uploads an image file to the public/uploads directory.
     *
     * @param \Illuminate\Http\UploadedFile $image
     *     The uploaded image file instance.
     *
     * @return array
     *     Returns an array with:
     *     - 'name' => string (stored file name)
     *     - 'mime_type' => string (e.g. image/png)
     *     - 'path' => string (storage path relative to public)
     *     - 'size' => int (file size in bytes)
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *     If file upload fails.
     */
    public function uploadImage(UploadedFile $image) : array
    {
        try {
            $filename = time() . '_' . $image->getClientOriginalName();
            
            $path = $image->storeAs('uploads', $filename, 'public');

            return [
                'name' => $filename,
                'mime_type' => $image->getMimeType(),
                'path' => 'storage/'.$path,
                'size' => $image->getSize()   
            ];

        } catch (\Throwable $th) {
            throw new HttpException(
                500,
                'Image upload failed.',
                $th
            );
        }
    
    }
}
