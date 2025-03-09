<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nature_id',
        'group_under_id',
        'description',
        'user_id',
    ];

    // Define the relationship with the Nature model
    public function nature()
    {
        return $this->belongsTo(Nature::class);
    }

    // Define the relationship with the Group Under model
    public function groupUnder()
    {
        return $this->belongsTo(GroupUnder::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
