<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeacherController;
use App\Models\User;
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

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('forgot-password', [AuthController::class, 'showForgotPassword']);
    Route::post('forgot-password', [AuthController::class, 'sendForgotPasswordEmail']);

    Route::get('reset-password/{token}/{email}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::get('/google-sign-in', [AuthController::class, 'loginWithGoogle']);
    Route::get('/login-with-google', [AuthController::class, 'googleLoginRedirect']);

    Route::get('/gitlab-sign-in', [AuthController::class, 'loginWithGitlab']);
    Route::get('/login-with-gitlab', [AuthController::class, 'gitlabLoginRedirect']);

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
    Route::get('users/search', function () {
        $term = request()->input('term');

        return
        ['results' => User::where('name', 'like', '%' . $term . '%')
            ->select([
                'id',
                'name as text'
            ])
            ->get()];
    });

    Route::resource('areas', AreaController::class);
    Route::resource('sessions', SessionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('teachers', TeacherController::class);
});

