<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Channel;
use App\Models\Frontend\VideoUpload;
use App\Models\PrivateVideo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        return view('test');
    }

    public function channel_search(Request $r)
    {
        $searchTerm = $r->cname;

        $obj = Channel::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('slug', 'LIKE', "%{$searchTerm}%")->get();

        return $obj;
    }
}
