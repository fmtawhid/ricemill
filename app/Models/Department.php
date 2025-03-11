<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Add 'name' and 'user_id' to the fillable property
    protected $fillable = ['name', 'user_id'];
    
    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}