<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Godown extends Model
{
    use HasFactory;
    protected $fillable = [
        'godown_name',
        'description',
        'user_id',
    ];

    // Define the relationship to the user (owner)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
