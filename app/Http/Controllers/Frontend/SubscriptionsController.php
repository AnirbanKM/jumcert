<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function index()
    {
        return view('frontend.pages.subscriptions');
    }
}
