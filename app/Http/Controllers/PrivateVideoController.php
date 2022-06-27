<?php

namespace App\Http\Controllers;

use App\Models\Backend\AdminCommission;
use App\Models\Frontend\UserAccount;
use App\Models\Frontend\VideoUpload;
use App\Models\Payment\Order;
use App\Models\PrivateVideo;
use App\Models\Wallet;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PrivateVideoController extends Controller
{
    public function payment(Request $r)
    {
        $vid = $r->vId;
        $query = VideoUpload::join('user_accounts', 'video_uploads.user_id', '=', 'user_accounts.user_id')
            ->where('video_uploads.id', $vid)
            ->first();

        // get video info
        $vname = $query->title;
        $price =  $query->price;

        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $price;
        $amount *= 100;
        $amount = (int) $amount;

        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $amount,
            'currency' => 'USD',
            'description' => 'Payment from Jumcert',
            'payment_method_types' => ['card'],
            'transfer_group' => 'ORDER100',
        ]);
        $intent = $payment_intent->client_secret;

        return view('frontend.pages.payment.private_video_checkout', [
            'intent' => $intent,
            'vname' => $vname,
            'videoId' => $vid,
            'price' => $price,
        ]);
    }

    public function private_payment_process(Request $r)
    {
        $userId = auth()->user()->id;

        $videoId = $r->videoId;
        $price = $r->price;

        $payment_id = $r->payment_id;
        $client_secret = $r->client_secret;
        $payment_method = $r->payment_method;
        $status = "Success";

        try {
            // Find Channel Owner
            $videoInfo = VideoUpload::find($videoId);
            $video_owner_id = $videoInfo->user_id;

            // Find Channel Owner Role
            $order = Order::where('user_id', $video_owner_id)->first();
            $plan_name = $order->plan_name;

            // Get commission info
            $commission = AdminCommission::where('role', $plan_name)->first();
            $acommission = $commission->acommission;
            $ucommission = $commission->ucommission;

            // Calculate percentage
            $set_admin_commission = ($price * $acommission) / 100;
            $set_channel_commission = ($price * $ucommission) / 100;

            // Now store the value for future
            // $wallet = Wallet::where('channel_owner_id', $video_owner_id)->first();

            $createWallet = new Wallet();
            $createWallet->channel_owner_id = $video_owner_id;
            $createWallet->admin_commission = $set_admin_commission;
            $createWallet->user_commission = $set_channel_commission;
            $createWallet->buyer_id = $userId;
            $createWallet->save();

            $channelOwnerId = $createWallet->channel_owner_id;

            // Fetch user wallet info
            $wallet = Wallet::where('channel_owner_id', $channelOwnerId)->first();
            $user_commission =  $wallet->user_commission;

            // Fetch user account
            $user_account = UserAccount::where('user_id', $channelOwnerId)->first();
            $user_bank_account_id = $user_account->bank_account_id;

            $response = Http::asForm()
                ->withToken(env('STRIPE_SECRET'))
                ->post(
                    'https://api.stripe.com/v1/payouts',
                    [
                        'amount' =>  $user_commission,
                        'currency' => 'usd',
                        'destination' => $user_bank_account_id,
                    ]
                );

            // Create Record for private video
            $obj = new PrivateVideo();
            $obj->payment_id = $payment_id;
            $obj->user_id = $userId;
            $obj->video_id = $videoId;
            $obj->price = $price;
            $obj->client_secret = $client_secret;
            $obj->payment_method = $payment_method;
            $obj->status = $status;
            $obj->save();

            echo json_encode(['status' => 200]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function video_payment_success()
    {
        return view('frontend.pages.success.video_purchase_success');
    }
}
