<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects'; 

    protected $fillable = [
        'name',
        'deskripsi',
        'status',
        'partner_id',
        'partner_name',
        'created_user_id',
        'PM_id',
        'dueDate',
    ];

    protected $casts = [
        'dueDate' => 'date',
        'created_at' => 'datetime',
    ];

    public function partner()
    {
        return $this->belongsTo(Partnership::class, 'partner_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'PM_id');
    }

    public function checkPoints(): HasMany
    {
        return $this->hasMany(CheckPoint::class, 'project_id');
    }

    public function jointWorkers(): HasMany
    {
        return $this->hasMany(JointWorker::class, 'project_id');
    }
}