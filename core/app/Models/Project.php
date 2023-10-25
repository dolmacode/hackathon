<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\FlareClient\Solutions\ReportSolution;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'admin_id',
        'status',
    ];

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function tasks() {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'project_id', 'id');
    }

    public function files() {
        return $this->hasMany(File::class, 'project_id', 'id');
    }

    public function reports() {
        return $this->hasMany(Report::class, 'project_id', 'id');
    }

    public function task_costs() {
        return $this->hasMany(TaskCost::class, 'project_id', 'id');
    }

    public function statuses() {
        return $this->hasMany(Status::class, 'project_id', 'id');
    }

    public function members() {
        return $this->hasMany(UserToProject::class, 'project_id', 'id');
    }

    public function roles() {
        return $this->hasMany(RoleToPermission::class, 'project_id', 'id');
    }
}
