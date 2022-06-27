<?php

namespace App\Models;

use App\Models\Frontend\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_owner_id',
        'admin_commission',
        'user_commission',
    ];

    public function channelOwner()
    {
        return $this->belongsTo(Channel::class, 'channel_owner_id', 'user_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }
}
