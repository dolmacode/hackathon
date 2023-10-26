<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\RoleToPermission;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskCost;
use App\Models\UserToProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index() {
        return view('pages.index');
    }

    private function getProjects() {
        $projects_own = Project::where('admin_id', Auth::id())->get();
        $projects_member = UserToProject::with('project')->where('user_id', Auth::id())->get();

        $projects = [];

        foreach ($projects_own as $project) {
            $projects[] = $project;
        }

        foreach ($projects_member as $project) {
            $projects[] = $project->project;
        }

        return $projects;
    }

    public function dashboard($project_id = null) {
        $projects = $this->getProjects();

        if (empty($projects)) {
            return redirect('/project/create');
        }

        if ($project_id != null) {
            $tasks = Category::with('tasks')->where('project_id', $project_id)->get();
        } else $tasks = null;

        $data = [
            'projects' => $projects,
            'tasks' => $tasks,
        ];

        return view('pages.dashboard', $data);
    }

    public function project($project_id) {
        $data = [
            'project' => Project::with(['members'])->find($project_id),
            'roles' => RoleToPermission::where('project_id', $project_id)->get(),
        ];

        return view('pages.project', $data);
    }

    public function board($project_id) {
        $data = [
            'project' => !empty(Project::find($project_id)) ? Project::with(['members', 'statuses', 'statuses.tasks', 'statuses.tasks.members', 'statuses.tasks.comments'])->find($project_id) : null,
            'projects' => $this->getProjects(),
            'tasks_count' => Task::where('project_id', $project_id)->count(),
            'completed_tasks_count' => Task::where('project_id', $project_id)->where('is_completed', 1)->count(),
            'task_costs' => TaskCost::where('project_id', $project_id)->get(),
            'statuses' => Status::where('project_id', $project_id)->get(),
            'categories' => Category::where('project_id', $project_id)->get(),
        ];

        return view('pages.dashboard', $data);
    }

    public function login() {
        return view('pages.login');
    }

    public function signup() {
        return view('pages.signup');
    }

    public function create_project() {
        $data = [
            'members' => null,
            'roles' => null,
        ];

        return view('pages.project', $data);
    }
}
