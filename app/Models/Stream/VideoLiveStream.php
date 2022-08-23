<?php

namespace App\Models\Stream;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLiveStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'creater_id',
        'start_date',
        'end_date',
        'roomName',
        'roomUrl',
        'meetingId',
        'hostRoomUrl'
    ];
}
