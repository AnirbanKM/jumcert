<?php

namespace App\Http\Controllers;

use App\Models\Backend\AdminCommission;
use App\Models\ConnectedAccountInfo;
use App\Models\Frontend\PrivateStream;
use App\Models\Frontend\UserAccount;
use App\Models\LiveStream;
use App\Models\Payment\Order;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrivateStreamController extends Controller
{
    // Join audience as Private stream
    public function join_Private_Stream(Request $r)
    {
        $streamId = $r->streamId;

        $query = LiveStream::join('connected_accounts', 'live_streams.user_id', '=', 'connected_accounts.user_id')
            ->where('live_streams.id', $streamId)
            ->first();

        if ($query != null) {
            $query = LiveStream::where('id', $streamId)->first();

            // get video info
            $stopic = $query->topic;
            $sprice =  $query->price;
            $channelId =  $query->channel_id;
            $playlistId =  $query->playlist_id;
            $userId =  $query->user_id;

            // Enter Your Stripe Secret
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $amount = $sprice;
            $amount *= 100;
            $amount = (int) $amount;

            $payment_intent = \Stripe\PaymentIntent::create([
                'description' => 'Stripe Live Payment',
                'amount' => $amount,
                'currency' => 'USD',
                'description' => 'Payment from Jumcert',
                'payment_method_types' => ['card'],
            ]);
            $intent = $payment_intent->client_secret;
            return view('frontend.pages.payment.private_stream_checkout', [
                'intent' => $intent,
                'streamId' => $streamId,
                'sname' => $stopic,
                'price' => $sprice,
                'channelId' => $channelId,
                'playlistId' => $playlistId,
                'userId' => $userId
            ]);
        } else {
            return redirect()->route('stream')->with('error', 'stream is currently not available for purchase.');
        }
    }

    public function private_stream_payment_process(Request $r)
    {
        $streamId = $r->stream_id;
        $price = $r->price;
        $channelId = $r->channelId;
        $playlistId = $r->playlistId;

        $payment_id = $r->payment_id;
        $client_secret = $r->client_secret;
        $payment_method = $r->payment_method;
        $status = "Success";

        $hostUserId = $r->hostId;

        try {

            $userinfo = Order::where('user_id', $hostUserId)->first();
            $userPlanName = $userinfo->plan_name;

            if ($userPlanName == "Pro") {
                $setBuyerLimit = 1;
            } else {
                $setBuyerLimit = 0;
            }

            $userId = auth()->user()->id;

            // Find LiveStream info
            $stream = LiveStream::find($streamId);
            $stream->stream_buyer_limit = $setBuyerLimit;
            $stream->update();

            // Get info of purchased stream
            $stream_owner_id = $stream->user_id;
            $stream_price = $stream->price;

            // Set commission
            $count_commission = (int) ($stream_price * 81) / 100;

            // Find stream owner bank account info
            $account = ConnectedAccountInfo::where('user_id', $stream_owner_id)->first();
            $video_owner_account_id = $account->connected_account_id;

            // Stripe Initialize
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

            // Save the buyer who purchased the stream
            $obj = new PrivateStream();
            $obj->stream_id = $streamId;
            $obj->channel_id = $channelId;
            $obj->playlist_id = $playlistId;
            $obj->buyer_id = auth()->user()->id;
            $obj->price = $price;

            $obj->payment_id = $payment_id;
            $obj->client_secret = $client_secret;
            $obj->payment_method = $payment_method;
            $obj->status = $status;
            $obj->save();

            $w = array(
                'status' => 200
            );
            echo json_encode($w);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function stream_payment_success()
    {
        return view('frontend.pages.success.stream_purchase_success');
    }
}
