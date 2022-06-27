<?php

namespace App\Http\Controllers;

use App\Models\Frontend\UserAccount;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    public function user_wallet()
    {
        $user = auth()->user()->id;
        $wallet = Wallet::where('channel_owner_id', $user)->first();
        return view('frontend.pages.wallet.wallet', ['wallet' => $wallet]);
    }

    public function credit_user_account(Request $r)
    {
        $user = auth()->user()->id;

        // Fetch user wallet info
        $wallet = Wallet::where('channel_owner_id', $user)->first();
        $user_commission =  $wallet->user_commission;

        // Fetch user account
        $user_account = UserAccount::where('user_id', $user)->first();
        $user_bank_account_id = $user_account->bank_account_id;

        $response = Http::asForm()
            ->withToken('sk_test_51KZo9yG6d8NW7tSt7425Hb2Bq8FTBVfVtqADD0F5Ug9OBRNre475ldk0N4zNv2b7DvdDFzZfNqE2ynnLuZEYP6gS0006PVsk8j')
            ->post(
                'https://api.stripe.com/v1/payouts',
                [
                    'amount' =>  $user_commission,
                    'currency' => 'usd',
                    'destination' => $user_bank_account_id,
                ]
            );

        // User user wallet
        $wallet->admin_commission = 0;
        $wallet->user_commission = 0;
        $wallet->update();

        return redirect()->route('user_wallet')->with('success', 'Your commission credited into your account');
    }
}
