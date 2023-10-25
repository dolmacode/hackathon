<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
