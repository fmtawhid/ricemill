<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    // Add the fields that are mass assignable
    protected $fillable = ['name', 'user_id'];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
