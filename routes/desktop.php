<?php

use App\Http\Controllers\API\Desktop\AuthController;
use App\Http\Controllers\API\Desktop\ProductController;
use App\Http\Controllers\API\Desktop\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'validate.user']], function () {
});

Route::get('products', [ProductController::class, 'index'])
    ->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])
    ->name('product.show');
Route::post('products', [ProductController::class, 'store'])
    ->name('product.store');
Route::put('products/{product}', [ProductController::class, 'update'])
    ->name('product.update');
Route::delete('products/{product}', [ProductController::class, 'delete'])
    ->name('product.delete');
Route::post('products/bulk-create', [ProductController::class, 'bulkStore'])
    ->name('product.store.bulk');
Route::post('products/bulk-update', [ProductController::class, 'bulkUpdate'])
    ->name('product.update.bulk');
Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])
    ->name('product.force.delete')
    ->middleware([]);
Route::get('users', [UserController::class, 'index'])
    ->name('users.index');
Route::get('users/{user}', [UserController::class, 'show'])
    ->name('user.show');
Route::post('users', [UserController::class, 'store'])
    ->name('user.store');
Route::put('users/{user}', [UserController::class, 'update'])
    ->name('user.update');
Route::delete('users/{user}', [UserController::class, 'delete'])
    ->name('user.delete');
Route::post('users/bulk-create', [UserController::class, 'bulkStore'])
    ->name('user.store.bulk');
Route::post('users/bulk-update', [UserController::class, 'bulkUpdate'])
    ->name('user.update.bulk');

Route::post('register', [AuthController::class, 'register'])
    ->name('register');
Route::post('login', [AuthController::class, 'login'])
    ->name('login');
Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:sanctum');
Route::put('change-password', [AuthController::class, 'changePassword'])
    ->name('change.password')
    ->middleware(['auth:sanctum', 'validate.user']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');
Route::post('validate-otp', [AuthController::class, 'validateResetPasswordOtp'])
    ->name('reset.password.validate.otp');
Route::put('reset-password', [AuthController::class, 'resetPassword'])
    ->name('reset.password');
