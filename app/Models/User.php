<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Projects created by this user
    public function createdProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_user_id');
    }

    // Projects where this user is PM
    public function managedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'pm_id');
    }

    // Personal Tasks
    public function personalTasks(): HasMany
    {
        return $this->hasMany(PersonalTask::class, 'user_id');
    }

    // Checkpoints where this user is PM
    public function managedCheckPoints(): HasMany
    {
        return $this->hasMany(CheckPoint::class, 'pm_id');
    }

    // Joint worker records where user is PM
    public function managedWorkers(): HasMany
    {
        return $this->hasMany(JointWorker::class, 'pm_id');
    }

    // Joint worker records where user is Worker
    public function workAssignments(): HasMany
    {
        return $this->hasMany(JointWorker::class, 'worker_id');
    }
}
