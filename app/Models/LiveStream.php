<?php

namespace App\Models;

use App\Models\Frontend\Channel;
use App\Models\Frontend\Playlist;
use App\Models\Frontend\PrivateStream;
use App\Models\Payment\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'streamDateTime',
        'topic',
        'role',
        'channel_id',
        'playlist_id',
        'description',
        'stream_type',
        'price',
        'status',
        'total_views',
        'roomName',
        'meetingId',
        'hostRoomUrl',
        'audienceRoomUrl'
    ];

    public function playListInfo()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id', 'id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function user_purchased_video()
    {
        return $this->belongsTo(PrivateStream::class, 'id', 'stream_id');
    }

    public function host_user_plan_info()
    {
        return $this->belongsTo(Order::class, 'user_id', 'user_id');
    }
}
