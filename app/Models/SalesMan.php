<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'number', 'email', 'address', 'salary', 'image','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
