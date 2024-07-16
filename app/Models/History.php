<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'name', 'category', 'technician', 'created_at', 'progress_at', 'finished_at', 'duration'
    ];

    // Example relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
