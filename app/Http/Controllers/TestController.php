<?php

namespace App\Http\Controllers;

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
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $bal = $stripe->balance->retrieve();
        $payOutAmount = (int)$bal->available[0]->amount ?? null;

        if ((($payOutAmount !== null)) &&  ($payOutAmount <= 0)) {

            $res = $stripe->topups->create(
                [
                    'amount' => 20000,
                    'currency' => 'usd',
                    'description' => 'Top-up for week of ' . date('Y-m-d'),
                    'statement_descriptor' => 'Weekly top-up',
                ]
            );
        }
    }
}
