<?php

try {
    // $obj = new PrivateStream();
    // $obj->stream_id = $streamId;
    // $obj->channel_id = $channelId;
    // $obj->playlist_id = $playlistId;
    // $obj->buyer_id = auth()->user()->id;
    // $obj->price = $price;

    // $obj->payment_id = $payment_id;
    // $obj->client_secret = $client_secret;
    // $obj->payment_method = $payment_method;
    // $obj->status = $status;
    // $obj->save();

    // Find LiveStream info
    // $stream = LiveStream::find($streamId);
    // $stream->stream_buyer_limit = $setBuyerLimit;
    // $stream->update();

    // $stream_owner_id = $stream->user_id;

    // Find Channel Owner Role
    $order = Order::where('user_id', $stream_owner_id)->first();
    $plan_name = $order->plan_name;

    // Get commission info
    $commission = AdminCommission::where('role', $plan_name)->first();
    $acommission = $commission->acommission;
    $ucommission = $commission->ucommission;

    // Calculate percentage
    $set_admin_commission = ($price * $acommission) / 100;
    $set_channel_commission = ($price * $ucommission) / 100;

    $createWallet = new Wallet();
    $createWallet->channel_owner_id = $stream_owner_id;
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

    $w = array(
        'status' => 200, $stream_owner_id, $wallet
    );
    echo json_encode($w);
} catch (\Throwable $th) {
    throw $th;
}
