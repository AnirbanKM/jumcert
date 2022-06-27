<?php

namespace App\Models\Frontend;

use App\Models\User;
use App\Models\UserProfileInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'channel_id',

        'owner_id',
        'sender_id',
        'receiver_id',

        'msg',
        'status'
    ];

    public function userinfo()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfileInfo::class, 'sender_id', 'user_id');
    }

    public function receiverInfo()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
