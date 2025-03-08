<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'keywords', 'tags', 'short_summary', 'video_link', 'image', 'category_id', 'status', 'date', 'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function newsType()
    {
        return $this->belongsTo(NewsType::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

