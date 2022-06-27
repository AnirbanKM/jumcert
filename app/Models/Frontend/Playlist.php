<?php

namespace App\Models\Frontend;

use App\Models\User;
use App\Models\UserProfileInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'image',
        'desc'
    ];

    public function videos()
    {
        $user_id = auth()->user()->id;
        return $this->belongsTo(VideoUpload::class, 'id', 'playlist_id')->where('user_id', $user_id);
    }

    public function frontendVideos()
    {
        return $this->belongsTo(VideoUpload::class, 'id', 'playlist_id');
    }

    public function user_info()
    {
        return $this->hasOne(UserProfileInfo::class, 'user_id', 'user_id');
    }
}
