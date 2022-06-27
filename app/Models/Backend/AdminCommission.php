<?php

namespace App\Models\Backend;

use App\Models\Frontend\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'acommission',
        'ucommission'
    ];
}
