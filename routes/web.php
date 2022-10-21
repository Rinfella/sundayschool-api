<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});


Route::group([
    'prefix' => 'auth',
    'middleware' => 'guest'
], function() {
    Route::get('register', [AuthController::class, 'showRegistrationForm']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('forgot-password', [AuthController::class, 'showForgotPassword']);
    Route::post('forgot-password', [AuthController::class, 'sendForgotPasswordEmail']);

    Route::get('reset-password/{token}/{email}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

});

Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::group([
    'prefix' => 'admin',
    'middleware' => [
        'auth',
    ]
], function () {
    Route::get('/', function() {
        return view('dashboard.index');
    });
    ROute::resource('areas', AreaController::class);
});

