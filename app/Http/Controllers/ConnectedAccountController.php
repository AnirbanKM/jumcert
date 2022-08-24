<?php

namespace App\Http\Controllers;

use App\Models\ConnectedAccount;
use Illuminate\Http\Request;

class ConnectedAccountController extends Controller
{
    public function index()
    {
        $account = ConnectedAccount::where('user_id', auth()->user()->id)->first();
        return view('frontend.pages.connectaccount.index', ['account' => $account]);
    }

    public function stripe_create_account(Request $r)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {

            $account = $stripe->accounts->create([
                'type' => 'custom',
                'capabilities[card_payments][requested]' => 'true',
                'capabilities[transfers][requested]' => 'true',
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
                'tos_acceptance[date]' => strtotime("now"),
                'tos_acceptance[ip]' => '8.8.8.8'
            ]);


            $obj = new ConnectedAccount();
            $obj->user_id = auth()->user()->id;
            $obj->connected_account_id = $account->id;
            $obj->save();

            return redirect()->route('connected_account')->with('success', 'Account Created successfully');
        } catch (\Throwable $th) {

            return redirect()->route('connected_account')->with('error', 'Something went wrong');
        }
    }
}