<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function mark_task($task_id) {
        $task = Task::find($task_id);

        if ($task) {
            $task->is_completed = !$task->is_completed;
            $task->save();
        }

        return back();
    }
}
