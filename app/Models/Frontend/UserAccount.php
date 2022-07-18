<?php

namespace App\Models\Frontend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resp_id',
        'resp_object',
        'bank_account_id',
        'bank_account_object',
        'account_holder_name',
        'account_holder_type',
        'account_type',
        'bank_name',
        'country',
        'currency',
        'fingerprint',
        'last4',
        'routing_number',
        'account_number',
        'status',
        'client_ip',
        'created',
        'livemode',
        'type',
        'used'
    ];

    public function account()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
