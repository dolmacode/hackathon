<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\RoleToPermission;
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

        return redirect('/dashboard');
    }

    public function invite(Request $request) {
        $email = $request->email;


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
