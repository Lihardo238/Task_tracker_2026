<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalTask extends Model
{
    use HasFactory;

    protected $table = 'personal_tasks';

    protected $fillable = [
        'user_id',
        'title',
        'deskripsi',
        'dueDate',
        'status',
    ];

    protected $casts = [
        'dueDate' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}