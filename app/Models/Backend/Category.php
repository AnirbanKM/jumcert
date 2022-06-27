<?php

namespace App\Models\Backend;

use App\Models\Frontend\VideoUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc'
    ];

    public function video()
    {
        return $this->hasMany(VideoUpload::class, 'category_id', 'id');
    }
}
