<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account_group_id',
        'phone_number',
        'email',
        'opening_balance',
        'debit_credit',
        'status',
        'address',
        'user_id',
    ];

    // Define the relationship with the AccountGroup model
    public function accountGroup()
    {
        return $this->belongsTo(AccountGroup::class, 'account_group_id');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
