<?php

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

Route::prefix('v1')->group(function () {
    // Public Discovery
    Route::get('/home', [App\Http\Controllers\Api\HomeController::class, 'getHomeData']);

    // Student Dashboard
    Route::get('/student/dashboard', [App\Http\Controllers\Api\StudentDashboardController::class, 'getDashboardData']);

    // Admin Dashboard
    Route::get('/admin/dashboard', [App\Http\Controllers\Api\AdminDashboardController::class, 'getDashboardData']);
});

