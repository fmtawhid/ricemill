<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'note',
        'user_id',  // Foreign key to User
    ];

    // Define the relationship to User (each currency belongs to one user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
