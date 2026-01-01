<?php

use App\Http\Controllers\ImageConverterController;
use App\Http\Controllers\ImageToPdfController;
use App\Http\Controllers\PdfCompressController;
use App\Http\Controllers\PdfToImageController;
use App\Http\Controllers\PdfUnlockController;
use Illuminate\Support\Facades\Route;

// --- Public Tools Routes ---
Route::prefix('tools')->name('tools.')->group(function () {
    Route::get('/jpg-to-pdf', [ImageToPdfController::class, 'index'])->name('jpg-to-pdf');
    Route::post('/jpg-to-pdf/convert', [ImageToPdfController::class, 'convert'])->name('jpg-to-pdf.convert');
    Route::get('/pdf-to-image', [PdfToImageController::class, 'index'])->name('pdf-to-image');
    Route::post('/pdf-to-image/convert', [PdfToImageController::class, 'convert'])->name('pdf-to-image.convert');
    Route::get('/image-converter', [ImageConverterController::class, 'index'])->name('image-converter');
    Route::post('/image-converter/convert', [ImageConverterController::class, 'convert'])->name('image-converter.convert');
    Route::get('/pdf-compress', [PdfCompressController::class, 'index'])->name('pdf-compress');
    Route::post('/pdf-compress/compress', [PdfCompressController::class, 'compress'])->name('pdf-compress.compress');
    Route::get('/pdf-unlock', [PdfUnlockController::class, 'index'])->name('pdf-unlock');
    Route::post('/pdf-unlock/unlock', [PdfUnlockController::class, 'unlock'])->name('pdf-unlock.unlock');
});
