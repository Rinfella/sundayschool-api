<?php

use App\Http\Controllers\AreaController;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;
=======
>>>>>>> 8364e9aa7a93402bdf87b72bf33c672cd5da4951
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
<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'auth',
    'middleware' => 'guest'
], function() {
    Route::get('register', [AuthController::class, 'showRegistrationForm']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('login', [AuthController::class, 'showLogin']);
    Route::post('login', [AuthController::class, 'login']);

    Route::get('forgot-password', [AuthController::class, 'showForgotPassword']);

    Route::get('reset-password', [AuthController::class, 'showResertPassword']);

});

=======

// Route::get('/', function () {
//     return view('welcome');
// });
>>>>>>> 8364e9aa7a93402bdf87b72bf33c672cd5da4951
Route::resource('areas',AreaController::class);
