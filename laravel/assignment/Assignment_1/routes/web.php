<?php

use App\Models\Student;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentAPIController;

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

// Redirect to student list
Route::get('/', function () {
    return redirect()->route('students.index');
});

// Students list resource route
Route::resource('students', StudentController::class)->except('show');
Route::get('students/download', [StudentController::class, 'downloadStudentCSV'])->name('downloadStudentCSV');
Route::get('students/upload', [StudentController::class, 'showStudentUploadView'])->name('students.uploadView');
Route::post('students/upload', [StudentController::class, 'submitStudentUpload'])->name('students.upload');

// API view routes
Route::prefix('api')->group(function () {
    Route::get('students/show', [StudentAPIController::class, 'showListView'])->name('api#showListView');
    Route::get('students/showCreateView', [StudentAPIController::class, 'showCreateView'])
        ->name('api#showCreateView');
    Route::get('students/showEditView/{id}', [StudentAPIController::class, 'showEditView'])
        ->name('api#showEditView');
});
