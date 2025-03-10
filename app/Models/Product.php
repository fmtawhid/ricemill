<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name', 
        'item_part', 
        'unit_id', 
        'category_id', 
        'purchase_price', 
        'sales_price', 
        'godown_id', 
        'previous_stock', 
        'total_previous_stock', 
        'description', 
        'user_id'
    ];

    // Relationships
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function godown()
    {
        return $this->belongsTo(Godown::class, 'godown_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
