<?php

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'login'])->name('login');
    Route::post('/register', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'register'])->name('register');
});

Route::middleware('substitute.binding')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('products', \App\Http\Controllers\Api\V1\Admin\ProductController::class);
            Route::resource('banners', \App\Http\Controllers\Api\V1\Admin\BannerController::class)->only('index', 'store', 'destroy');
        });
        Route::post('carts/payment', [\App\Http\Controllers\Api\V1\User\CartController::class, 'pay']);
        Route::resource('carts', \App\Http\Controllers\Api\V1\User\CartController::class);
        Route::resource('wishlists', \App\Http\Controllers\Api\V1\User\WishlistController::class);
    });

    Route::get('/products/recommendation', [\App\Http\Controllers\Api\V1\User\ProductController::class, 'recommendation'])->name('products.recommendation');
    Route::resource('products', \App\Http\Controllers\Api\V1\User\ProductController::class)->only(
        ['show', 'index'],
    )->parameters(
        ["products" => "product:slug"],
    );
});
