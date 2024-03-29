<?php

namespace App\Models;

use App\Models\Frontend\UserAccount;
use App\Models\Payment\Order;
use App\Models\Payment\Payment;
use App\Models\ConnectedAccount;
use App\Models\ConnectedAccountInfo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'stream_role',
        'password',
        'user_role',
        'facebook_id',
        'facebook_token',
        'google_id',
        'google_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userprofile()
    {
        return $this->hasOne(UserProfileInfo::class, 'user_id', 'id');
    }

    public function connectedAccount()
    {
        return $this->hasOne(ConnectedAccount::class, 'user_id', 'id');
    }

    public function connectedAccountInfo()
    {
        return $this->hasOne(ConnectedAccountInfo::class, 'user_id', 'id');
    }

    public function usersOrders()
    {
        return $this->belongsTo(Order::class, 'id', 'user_id');
    }

    public function usersPayment()
    {
        return $this->belongsTo(Payment::class, 'id', 'user_id');
    }
}
