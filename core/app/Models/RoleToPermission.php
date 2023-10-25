<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleToPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'project_id',
        'role_title',
        'permission',
        'permission_title',
    ];

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
