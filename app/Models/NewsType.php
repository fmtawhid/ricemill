<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    // In NewsType model
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
