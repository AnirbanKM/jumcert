<?php

namespace App\Models;

use App\Models\Frontend\VideoUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'user_id',
        'video_id',
        'price',
        'client_secret',
        'payment_method',
        'status'
    ];

    public function video()
    {
        return $this->belongsTo(VideoUpload::class, 'video_id', 'id');
    }
}
