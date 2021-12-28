<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

/**
 * Display All Tasks
 * 
 * @return \Illuminate\Http\Response
 */
Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * Add A New Task
 * 
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/')->with('success', 'Task created successfully.');
});

/**
 * Display One Task
 * 
 * @param  \App\Models\Task  $task
 * @return \Illuminate\Http\Response
 */
Route::get('/task/{task}', function (Task $task) {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'task' => $task,
        'tasks' => $tasks
    ]);
})->name('task#edit');

/**
 * Edit A Task
 * 
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Task  $task
 * @return \Illuminate\Http\Response
 */
Route::patch('/task/{task}', function (Request $request, Task $task) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task->name =  $request->name;
    $task->save();

    return redirect('/')->with('success', 'Task updated successfully.');
})->name('task#update');

/**
 * Delete An Existing Task
 * 
 * @param  $id
 * @return \Illuminate\Http\Response
 */
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});
