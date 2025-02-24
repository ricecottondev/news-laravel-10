<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function listFiles()
    {
        $path = public_path('images'); // Path to public folder
        $files = $this->scanFolder($path);
        return Response::json(['files' => $files]);
    }

    private function scanFolder($dir)
    {
        $files = [];
        foreach (File::allFiles($dir) as $file) {
            $files[] = $file->getRelativePathname();
        }
        foreach (File::directories($dir) as $folder) {
            $files[] = $folder . '/';
        }
        return $files;
    }
}
