<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partnership extends Model
{
    use HasFactory;

    protected $table = 'partnerships';

    protected $fillable = [
        'name',
        'contact_identity',
        'contact_number',
        'fax_email',
        'description',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'partner_id');
    }
}