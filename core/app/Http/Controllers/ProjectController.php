<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\RoleToPermission;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskCost;
use App\Models\User;
use App\Models\UserToProject;
use Couchbase\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function save(Request $request) {
        return !empty($request->project_id) ? $this->update($request) : $this->create($request);
    }

    private function update(Request $request) {
        $validated = $request->validate([
            'project_id' => "max:11",
            'name' => 'required',
            'description' => 'max:1000',
        ]);

        Project::find($validated['project_id'])->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'admin_id' => Auth::id(),
            'status' => 'queue',
        ]);

        return back();
    }

    private function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'max:1000',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'admin_id' => Auth::id(),
            'status' => 'queue',
        ]);
        $project->save();

        $this->seedProject($project->id);

        return redirect('/dashboard');
    }

    private function seedProject($project_id) {
        TaskCost::insert(['name' => 'Низкая', 'project_id' => $project_id]);
        TaskCost::insert(['name' => 'Средняя', 'project_id' => $project_id]);
        TaskCost::insert(['name' => 'Высокая', 'project_id' => $project_id]);

        Category::insert(['name' => 'Рядовые задачи', 'project_id' => $project_id]);

        Status::insert(['name' => 'Ожидание', 'slug' => 'todo', 'project_id' => $project_id]);
        Status::insert(['name' => 'В работе', 'slug' => 'in_work', 'project_id' => $project_id]);
        Status::insert(['name' => 'Завершено', 'slug' => 'completed', 'project_id' => $project_id]);

        RoleToPermission::insert(['role' => 'member', 'role_title' => 'Участник', 'permission' => 'all', 'permission_title' => "Все", 'project_id' => $project_id]);
    }

    public function invite_member($project_id, Request $request) {
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back();
        }

        $member = UserToProject::create([
            'user_id' => $user->id,
            'project_id' => $project_id,
        ]);

        $member->save();

        $to = $email;
        $subject = "Вы добавлены в проект";
        $message = "Вас добавили в список участников на проект '". Project::find($project_id)->name ."'";
        $headers = "From: info@techcraft.by" . "\r\n" .
            "Reply-To: info@techcraft.by" . "\r\n" .
            "Content-type: text/html; charset=utf-8\r\n" .
            "X-Mailer: PHP/" . phpversion();
        mail($to, $subject, $message, $headers);

        return back();
    }

    public function delete_member($member_id) {
        $member = UserToProject::find($member_id);

        if ($member) {
            $member->delete();
        }

        return back();
    }

    public function change_member_role($member_id, $new_role_slug) {
        $role = RoleToPermission::where('role', $new_role_slug)->first();

        if (!$role) {
            return response()->json(['error' => 'Не найдена роль'], 404);
        }

        $member = UserToProject::find($member_id);

        if (!$member) {
            return response()->json(['error' => 'Не найден участник'], 404);
        }

        $member->role = $new_role_slug;
        $member->save();

        return response()->json(['success' => 'Успешно обновлена роль участника'], 200);
    }
}
