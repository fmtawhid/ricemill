<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory;
    // Define fillable fields
    protected $fillable = ['name', 'account_number', 'phone_number', 'email', 'balance', 'note', 'user_id'];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
