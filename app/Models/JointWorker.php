<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JointWorker extends Model
{
    use HasFactory;
    protected $table ='joint_workers';

    protected $fillable = [
        'project_id',
        'pm_id',
        'worker_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'pm_id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}