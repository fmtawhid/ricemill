<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'keywords', 'tags', 'short_summary', 'video_link', 'image', 'category_id', 'status', 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function newsType()
    {
        return $this->belongsTo(NewsType::class);
    }
}

