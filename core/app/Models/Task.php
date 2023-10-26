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
        'is_completed',
        'category_id'
    ];

    public function status() {
        return $this->belongsTo(Status::class, 'status', 'id');
    }

    public function task_cost() {
        return $this->belongsTo(TaskCost::class, 'task_cost_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'task_id', 'id');
    }

    public function members() {
        return $this->hasMany(UserToTask::class, 'task_id', 'id');
    }
}
