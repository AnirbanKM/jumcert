<?php

namespace App\Models\Frontend;

use App\Models\LiveStream;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'stream_id',
        'stream_token',

        'channel_id',
        'playlist_id',
        'buyer_id',

        'price',
        'payment_id',
        'client_secret',
        'payment_method',

        'status'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function stream()
    {
        return $this->belongsTo(LiveStream::class, 'stream_id', 'id');
    }
}
