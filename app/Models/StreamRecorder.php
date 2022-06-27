<?php

namespace App\Models;

use App\Models\Frontend\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamRecorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_owner_id',
        'buyer_id',
        'video_path',
        'stream_id'
    ];

    public function streamInfo()
    {
        return $this->belongsTo(LiveStream::class, 'stream_id', 'id');
    }

    public function channerOwnerInfo()
    {
        return $this->belongsTo(Channel::class, 'channel_owner_id', 'user_id');
    }
}
