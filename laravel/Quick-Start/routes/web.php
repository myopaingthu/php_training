<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Task\TaskController;


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

// Redirect to task list
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Custom auth routes
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('registration', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
});
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Task list resource route
Route::resource('tasks', TaskController::class)->middleware('auth');
