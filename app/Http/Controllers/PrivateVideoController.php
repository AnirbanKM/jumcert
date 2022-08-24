<?php

namespace App\Http\Controllers;

use App\Models\Backend\AdminCommission;
use App\Models\ConnectedAccountInfo;
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
        $query = VideoUpload::join('connected_accounts', 'video_uploads.user_id', '=', 'connected_accounts.user_id')
            ->where('video_uploads.id', $vid)
            ->first();

        if ($query != null) {
            // get video info
            $vname = $query->title;
            $price =  $query->price;

            // Enter Your Stripe Secret
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $amount = $price;
            $amount *= 100;
            $amount = (int) $amount;

            $payment_intent = \Stripe\PaymentIntent::create([
                'description' => 'Stripe Live Payment',
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
        } else {
            return redirect()->route('home')->with('error', 'video is currently not available for purchase.');
        }
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
            $video_price = $videoInfo->price;

            $count_commission = (int) ($video_price * 81) / 100;

            $account = ConnectedAccountInfo::where('user_id', $video_owner_id)->first();
            $video_owner_account_id = $account->connected_account_id;

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $res = $stripe->transfers->create([
                'amount' => $count_commission * 100,
                'currency' => 'usd',
                'destination' => $video_owner_account_id,
                'transfer_group' => 'ORDER_95',
            ]);

            $stripe->accounts->update(
                $video_owner_account_id,
                [
                    'tos_acceptance[date]' => strtotime("now"),
                    'tos_acceptance[ip]' => '8.8.8.8'
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
