<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'task_cost_id',
        'description',
        'priority',
        'creator_id',
        'project_id',
        'deadline',
        'is_completed'
    ];

    public function status() {
        return $this->belongsTo(Status::class, 'status', 'slug');
    }

    public function task_cost() {
        return $this->belongsTo(TaskCost::class, 'task_cost_id', 'id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
