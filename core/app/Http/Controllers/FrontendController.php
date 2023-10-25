<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
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

    public function dashboard() {
        $projects = $this->getProjects();

        if (empty($projects)) {
            return redirect('/project/create');
        }

        $tasks = '';

        $data = [
            'projects' => $projects,
            'tasks' => $tasks,
        ];

        return view('pages.dashboard', $data);
    }

    public function project($project_id) {
        $data = [
            'project' => Project::with(['members'])->find($project_id),
        ];

        return view('pages.project', $data);
    }

    public function board($project_id) {
        $data = [
            'tasks' => Project::with(['members'])->find($project_id),
            'projects' => $this->getProjects(),
            'tasks_count' => Task::where('project_id', $project_id)->count(),
        ];

        return view('pages.project', $data);
    }

    public function login() {
        return view('pages.login');
    }

    public function signup() {
        return view('pages.signup');
    }

    public function create_project() {
        return view('pages.project');
    }
}
