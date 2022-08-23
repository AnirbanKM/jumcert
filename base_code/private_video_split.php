<?php

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
$user_commission = $wallet->user_commission;

// Fetch user account
$user_account = UserAccount::where('user_id', $channelOwnerId)->first();
$user_bank_account_id = $user_account->bank_account_id;

$response = Http::asForm()
    ->withToken(env('STRIPE_SECRET'))
    ->post(
        'https://api.stripe.com/v1/payouts',
        [
            'amount' => $user_commission,
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
