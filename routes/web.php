<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

// Setup rate limiter — max 10 request per menit per IP
RateLimiter::for('download', function ($request) {
    return Limit::perMinute(10)->by($request->ip());
});

Route::get('/', [FileController::class, 'index']);
Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');

Route::middleware(['throttle:download'])->group(function () {
    Route::get('/file/{token}', [FileController::class, 'show'])->name('file.show');
    Route::post('/file/{token}/password', [FileController::class, 'verifyPassword'])->name('file.password');
    Route::get('/file/{token}/download', [FileController::class, 'download'])->name('file.download');
});

Route::match(['get', 'post'], '/admin/logs', [FileController::class, 'adminLogs'])->name('admin.logs');

Route::delete('/admin/file/{id}', [FileController::class, 'adminDeleteFile'])->name('admin.delete');