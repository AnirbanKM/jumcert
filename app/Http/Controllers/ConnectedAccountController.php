<?php

namespace App\Http\Controllers;

use App\Models\Frontend\VideoUpload;
use App\Models\ConnectedAccount;
use App\Models\ConnectedAccountInfo;
use Illuminate\Http\Request;

class ConnectedAccountController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $account = ConnectedAccount::where('user_id', $user_id)->first();

        $account_info = ConnectedAccountInfo::where('user_id', $user_id)->first();

        $owner_videos = VideoUpload::join('private_videos', 'video_uploads.id', '=', 'private_videos.video_id')
            ->where('video_uploads.user_id', $user_id)
            ->paginate(2);

        if ($account != null) {
            $account_id = $account->connected_account_id;

            $stripe_resp = $stripe->accounts->retrieve(
                $account_id
            );

            $routing_number = $stripe_resp->external_accounts->data[0]->routing_number;
        } else {
            $account_id = '';
            $routing_number = '';
        }

        return view('frontend.pages.connectaccount.index', [
            'owner_videos' => $owner_videos,
            'account' => $account,
            'account_info' => $account_info,
            'routing_number' => $routing_number
        ]);
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

    public function pagination()
    {
        $user_id = auth()->user()->id;

        $owner_videos = VideoUpload::join('private_videos', 'video_uploads.id', '=', 'private_videos.video_id')
            ->where('video_uploads.user_id', $user_id)
            ->paginate(2);

        return view('frontend.pages.connectaccount.earning_pagination', ['owner_videos' => $owner_videos]);
    }
}
