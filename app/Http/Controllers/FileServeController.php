<?php

namespace App\Http\Controllers;

class FileServeController extends Controller
{
    public function serve(string $path): \Symfony\Component\HttpFoundation\Response
    {
        // Prevent directory traversal and null byte injection
        if (str_contains($path, '..') || str_contains($path, "\0")) {
            abort(403);
        }

        $filePath = storage_path('app/public/' . $path);

        if (!file_exists($filePath) || is_dir($filePath)) {
            abort(404);
        }

        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

        return response()->file($filePath, [
            'Content-Type'  => $mimeType,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
