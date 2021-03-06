<?php

namespace App\Http\Controllers\Task;

use App\Contracts\Services\Task\TaskServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * task interface
     */
    private $taskInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskServiceInterface $taskServiceInterface)
    {
        $this->taskInterface = $taskServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->taskInterface->getTaskList();

        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        // Check validation passed or not.
        if ($validator->fails()) {
            return redirect()
                ->route('tasks.index')
                ->withInput()
                ->withErrors($validator);
        }

        $task = $this->taskInterface->saveTask($request);

        // Check task is created successfully or not
        if ($task) {
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Task created successfully.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $tasks = $this->taskInterface->getTaskList();

        return view('tasks', [
            'task' => $task,
            'tasks' => $tasks
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        // Check validation passed or not.
        if ($validator->fails()) {
            return redirect()
                ->route('tasks.edit', [$task->id])
                ->withInput()
                ->withErrors($validator);
        }

        $task = $this->taskInterface->updateTask($request, $task);

        // Check task is updated successfully.
        if ($task) {
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Task updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $result = $this->taskInterface->deleteTask($task);

        // Check task is deleted successfully.
        if ($result) {
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Task deleted successfully.');
        }
    }
}
