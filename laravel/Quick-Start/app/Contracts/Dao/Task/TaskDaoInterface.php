<?php

namespace App\Contracts\Dao\Task;

use Illuminate\Http\Request;
use App\Models\Task;

/**
 * Interface for Data Accessing Object of task
 */
interface TaskDaoInterface
{
    /**
     * To get task list
     * @return $taskList
     */
    public function getTaskList();

    /**
     * To store post
     * @param Request $request request with inputs
     * @return Object $task saved task
     */
    public function saveTask(Request $request);

    /**
     * To update task
     * @param Request $request request with inputs
     * @param \App\Models\Task  $task
     * @return Object $task Post Object
     */
    public function updateTask(Request $request, Task $task);

    /**
     * To delete task
     * @param \App\Models\Task  $task
     * @return string $message message success or not
     */
    public function deleteTask(Task $task);
}
