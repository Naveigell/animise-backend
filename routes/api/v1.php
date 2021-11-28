<?php

Route::prefix('auth')
    ->name('auth.')->group(function () {

        Route::get('/login', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'login'])->name('login');
});
