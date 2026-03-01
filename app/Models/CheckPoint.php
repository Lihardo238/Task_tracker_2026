<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckPoint extends Model
{
    use HasFactory;

    protected $table = 'check_points';

    protected $fillable = [
        'project_id',
        'pm_id',
        'title',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'pm_id');
    }
}