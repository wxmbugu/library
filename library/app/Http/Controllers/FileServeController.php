<?php

namespace App\Http\Controllers;


class FileServeController extends Controller
{
    public function serve($file)
    {
        $filePath = storage_path("app/public/uploads/{$file}");

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}
