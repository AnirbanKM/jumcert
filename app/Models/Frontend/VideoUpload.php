<?php

namespace App\Models\Frontend;

use App\Models\Backend\Category;
use App\Models\PrivateVideo;
use App\Models\User;
use App\Models\UserProfileInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoUpload extends Model
{
    use HasFactory;

    protected $table = "video_uploads";

    protected $fillable = [
        'category',
        'subcategory',
        'title',
        'desc',
        'price',
        'user_id',
        'status',
        'videoname',
        'video_id',
        'playlist'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
        //foreignKey     //ownerKey
    }

    // User Main Information
    public function user_primary_info()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // User Profile Long Information
    public function user_info()
    {
        return $this->belongsTo(UserProfileInfo::class, 'user_id', 'user_id');
    }

    public function playlist_info()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id', 'id');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_videouploads', 'videoupload_id', 'playlist_id')->withTimestamps();
    }

    public function purchasedVideo()
    {
        return $this->belongsTo(PrivateVideo::class, 'id', 'video_id');
    }

    public function owner()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }

    public function checkPurchasedVideo()
    {
        return $this->belongsTo(PrivateVideo::class, 'id', 'video_id')->where('user_id', auth()->user()->id);
    }
}
