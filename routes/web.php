<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\SetAcademicSession;
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
    'middleware' => 'guest',
], function() {
    Route::get('register', [AuthController::class, 'showRegistrationForm']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('forgot-password', [AuthController::class, 'showForgotPassword']);
    Route::post('forgot-password', [AuthController::class, 'sendForgotPasswordEmail']);
    Route::get('reset-password/{token}/{email}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::get('/google-sign-in', [AuthController::class, 'loginWithGoogle']);
    Route::get('/login-with-google', [AuthController::class, 'googleLoginRedirect']);
});
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::group([
    'prefix' => 'admin',
    'middleware' => [
        'auth',
    ]
], function () {
    Route::resource('sessions', SessionController::class);

    Route::group([
        'middleware' => SetAcademicSession::class
    ], function () {
        Route::get('/', function(){
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

        Route::get('enrollment-entry', function () {
            return view('enrollments.entry');
        });

        Route::get('groups/{group}/enrollments', [EnrollmentController::class, 'showForGroup']);
        Route::get('groups/{group}/enrollments/create', [EnrollmentController::class, 'createForGroup']);
        Route::post('groups/{groupId}/enrollments', [EnrollmentController::class, 'storeForGroup']);

        Route::resource('areas', AreaController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('groups', GroupController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('enrollments', EnrollmentController::class);

        Route::get('settings', [SettingController::class,'index']);
        Route::post('settings', [SettingController::class, 'store']);
    });

});
