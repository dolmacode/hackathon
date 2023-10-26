<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskCost;
use App\Models\User;
use App\Models\UserToTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function get_info($task_id) {
        $task = Task::find($task_id);

        if (!$task) {
            return response()->json(['error' => 'Задача не найдена'], 404);
        }

        $task = Task::with(['status', 'task_cost', 'category', 'creator', 'project', 'comments', 'comments.user'])->find($task_id);

        return response()->json(['success' => [
            'task' => $task,
            'deadline' => date('Y-m-d', strtotime($task->deadline)),
            'task_costs' => TaskCost::where('project_id', $task->project_id)->get(),
            'categories' => Category::where('project_id', $task->project_id)->get(),
            'statuses' => Status::where('project_id', $task->project_id)->get(),
            'members' => UserToTask::with('user')->where('task_id', $task_id)->get(),
        ]], 200);
    }

    public function save(Request $request) {
        return empty($request->task_id) ? $this->create($request) : $this->update($request);
    }

    private function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'task_cost_id' => 'max:100',
            'description' => 'max:1000',
            'priority' => 'max:50|required',
            'deadline' => 'required',
            'category_id' => 'max:100',
            'project_id' => 'max:100',
        ]);

        $task = Task::create([
            'name' => $validated['name'],
            'status' => $validated['status'] ,
            'task_cost_id' => $validated['task_cost_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'],
            'deadline' => $validated['deadline'],
            'category_id' => $validated['category_id'],
            'creator_id' => Auth::id(),
            'project_id' => $validated['project_id'],
        ]);
        $task->save();

        return back();
    }

    private function update(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'task_cost_id' => 'max:100',
            'description' => 'max:1000',
            'priority' => 'max:50',
            'deadline' => 'required',
            'category_id' => 'max:100',
            'task_id' => 'required',
        ]);

        Task::find($validated['task_id'])->update([
            'name' => $validated['name'],
            'status' => $validated['status'] ,
            'task_cost_id' => $validated['task_cost_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'],
            'deadline' => $validated['deadline'],
            'category_id' => $validated['category_id'],
        ]);

        return back();
    }

    public function add_member(Request $request) {
        $member = UserToTask::create([
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
        ]);

        $member->save();

        $to = User::find($request->user_id)->email;
        $subject = "Вы назначены исполнителем";
        $message = "Вас назначили исполнителем на задачу '". Task::find($request->task_id)->name ."'";
        $headers = "From: info@techcraft.by" . "\r\n" .
            "Reply-To: info@techcraft.by" . "\r\n" .
            "Content-type: text/html; charset=utf-8\r\n" .
            "X-Mailer: PHP/" . phpversion();
        mail($to, $subject, $message, $headers);

        return back();
    }

    public function remove_member($member_id) {
        UserToTask::find($member_id)->delete();

        return back();
    }

    public function add_comment(Request $request) {
        $comment = Comment::create([
            'author_id' => Auth::id(),
            'task_id' => $request->task_id,
            'content' => $request->text_content,
        ]);

        $comment->save();

        return back();
    }
}
