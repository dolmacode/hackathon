<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function save(Request $request) {
        return !empty($request->project_id) ? $this->update($request) : $this->create($request);
    }

    private function update(Request $request) {
        $validated = $request->validate([
            'project_id',
            'name',
            'description',
        ]);

        Project::find($validated['project_id'])->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'admin_id' => Auth::id(),
            'status' => 'queue',
        ]);

        return redirect('/dashboard');
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
}
