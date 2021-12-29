<?php

use App\Http\Controllers\API\Admin\AuthController;
use App\Http\Controllers\API\Admin\PermissionController;
use App\Http\Controllers\API\Admin\ProductController;
use App\Http\Controllers\API\Admin\RoleController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'validate.user']], function () {
    Route::post('products', [ProductController::class, 'store'])
        ->name('product.store')
        ->middleware(['permission:create_product']);
    Route::get('products', [ProductController::class, 'index'])
        ->name('products.index')
        ->middleware(['permission:read_product']);
    Route::get('products/{product}', [ProductController::class, 'show'])
        ->name('product.show')
        ->middleware(['permission:read_product']);
    Route::put('products/{product}', [ProductController::class, 'update'])
        ->name('product.update')
        ->middleware(['permission:update_product']);
    Route::delete('products/{product}', [ProductController::class, 'delete'])
        ->name('product.delete')
        ->middleware(['permission:delete_product']);
    Route::post('products/bulk-create', [ProductController::class, 'bulkStore'])
        ->name('product.store.bulk')
        ->middleware(['permission:create_product']);
    Route::post('products/bulk-update', [ProductController::class, 'bulkUpdate'])
        ->name('product.update.bulk')
        ->middleware(['permission:update_product']);
    Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])
        ->name('product.force.delete')
        ->middleware(['permission:delete_product']);

    Route::post('users', [UserController::class, 'store'])
        ->name('user.store')
        ->middleware(['permission:create_user']);
    Route::get('users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware(['permission:read_user']);
    Route::get('users/{user}', [UserController::class, 'show'])
        ->name('user.show')
        ->middleware(['permission:read_user']);
    Route::put('users/{user}', [UserController::class, 'update'])
        ->name('user.update')
        ->middleware(['permission:update_user']);
    Route::delete('users/{user}', [UserController::class, 'delete'])
        ->name('user.delete')
        ->middleware(['permission:delete_user']);
    Route::post('users/bulk-create', [UserController::class, 'bulkStore'])
        ->name('user.store.bulk')
        ->middleware(['permission:create_user']);
    Route::post('users/bulk-update', [UserController::class, 'bulkUpdate'])
        ->name('user.update.bulk')
        ->middleware(['permission:update_user']);

    Route::get('roles', [RoleController::class, 'index'])
        ->name('role.index')
        ->middleware(['permission:manage_roles']);
    Route::get('roles/{role}', [RoleController::class, 'show'])
        ->name('role.show')
        ->middleware(['permission:manage_roles']);
    Route::post('roles', [RoleController::class, 'store'])
        ->name('role.store')
        ->middleware(['permission:manage_roles']);
    Route::put('roles/{role}', [RoleController::class, 'update'])
        ->name('role.update')
        ->middleware(['permission:manage_roles']);
    Route::delete('roles/{role}', [RoleController::class, 'delete'])
        ->name('role.delete')
        ->middleware(['permission:manage_roles']);
    Route::post('roles/bulk-create', [RoleController::class, 'bulkStore'])
        ->name('role.store.bulk')
        ->middleware(['permission:manage_roles']);
    Route::post('roles/bulk-update', [RoleController::class, 'bulkUpdate'])
        ->name('role.update.bulk')
        ->middleware(['permission:manage_roles']);

    Route::get('permissions', [PermissionController::class, 'index'])
        ->name('permission.index')
        ->middleware(['permission:manage_roles']);
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])
        ->name('permission.show')
        ->middleware(['permission:manage_roles']);

    Route::post('users/assign-role', [UserRoleController::class, 'assignRole'])
        ->name('users.role.assign')
        ->middleware(['permission:manage_roles']);
    Route::get('users/{user}/roles', [UserRoleController::class, 'getAssignedRoles'])
        ->name('get.assigned.roles')
        ->middleware(['permission:manage_roles']);
    Route::put('users/{user}/update-role', [UserRoleController::class, 'updateUserRole'])
        ->name('users.role.update')
        ->middleware(['permission:manage_roles']);
    Route::post('users/bulk-assign-role', [UserRoleController::class, 'bulkAssignRole'])
        ->name('users.bulk.assign.roles')
        ->middleware(['permission:manage_roles']);
});

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
