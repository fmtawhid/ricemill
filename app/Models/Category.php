<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'note',
        'user_id',
    ];

    // Relationship with User (each category belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
