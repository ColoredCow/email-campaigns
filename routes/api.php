<?php

use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SenderIdentityController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    Route::resource('subscriber', SubscriberController::class)->except(['create', 'edit']);
    Route::resource('tag', TagController::class)->except(['create', 'edit']);
    Route::resource('sender-identity', SenderIdentityController::class)->except(['create', 'edit']);
    Route::resource('campaign', CampaignController::class)->except(['create', 'edit']);
    Route::resource('role', RoleController::class)->except(['create', 'edit']);
    Route::resource('permission', PermissionController::class)->except(['create', 'edit']);
    Route::resource('user', UserController::class)->except(['create', 'edit']);
    Route::post('user/{user}/role', [UserController::class, 'updateUserRoles'])->name('user.update-roles');
    Route::post('role/{role}/permission', [RoleController::class, 'updateRolePermissions'])->name('role.update-permissions');
});

require __DIR__.'/api/auth.php';
