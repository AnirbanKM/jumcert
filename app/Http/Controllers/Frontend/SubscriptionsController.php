<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $plan_end_date = Carbon::parse(Auth::user()->upgradationDate)->addDays(28)->format('m/d/Y');

        $start_date = Carbon::parse(Auth::user()->upgradationDate)->format('Y-m-d');
        $end_date = Carbon::parse(strtotime("+672 hours"))->format('Y-m-d');

        $diff = strtotime($start_date) - strtotime($end_date);
        $total_days = ceil(abs($diff / 86400));

        return view('frontend.pages.subscriptions', [
            'plan_end_date' => $plan_end_date,
            'total_days' => $total_days
        ]);
    }
}
