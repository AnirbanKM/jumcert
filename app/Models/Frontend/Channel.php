<?php

namespace App\Models\Frontend;

use App\Models\PrivateVideo;
use App\Models\User;
use App\Models\UserProfileInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'slug',
        'desc',
        'user_id',
        'video_id'
    ];

    public function user_info()
    {
        return $this->hasOne(UserProfileInfo::class, 'user_id', 'user_id');
    }

    public function user_primary()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function purchasedVideo()
    {
        return $this->belongsTo(PrivateVideo::class, 'id', 'video_id');
    }
}
