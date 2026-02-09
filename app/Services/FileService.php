<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class FileService
{
    public function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $filename = bin2hex(random_bytes(10)) . '_' . time() . '.' . $file->getClientOriginalExtension();

        $destinationPath = public_path($folder);

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $file->move($destinationPath, $filename);

        return $folder . '/' . $filename;
    }

    public function delete(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
