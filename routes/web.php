<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

Route::get('/download-proof/{filename}', function ($filename) {
    // ✅ Cegah directory traversal (keamanan)
    if (Str::contains($filename, ['..', '/', '\\'])) {
        abort(400, 'Invalid filename.');
    }

    $filePath = 'payments/' . $filename;

    if (!Storage::disk('public')->exists($filePath)) {
        abort(404);
    }

    $fullPath = Storage::disk('public')->path($filePath);

    return Response::download(
        $fullPath,
        $filename,
        ['Content-Type' => File::mimeType($fullPath)]
    );
})->name('download.proof');

// Default route
Route::get('/', function () {
    return view('welcome');
});