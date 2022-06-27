<?php

namespace App\Http\Controllers;

use App\Models\Frontend\VideoUpload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function test()
    {
        dd(Auth::user());
    }
}
