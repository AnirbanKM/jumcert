<?php

namespace App\Http\Controllers;

use App\Models\Frontend\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserAccountController extends Controller
{
    public function index()
    {
        $uid = auth()->user()->id;
        $query = UserAccount::where('user_id', $uid)->with('account')->get();
        return view('frontend.pages.account.index', ['data' => $query]);
    }

    public function create_payment_info(Request $r)
    {
        dd($r);

        $country = $r->country;
        $currency = $r->currency;
        $accountHolderName = $r->account_holder_name;
        $accountHolderType = $r->account_holder_type;
        $routingNumber = $r->routing_number;
        $accountNumber = $r->account_number;

        $this->validate($r, [
            'country' => 'required|min:2|max:2',
            'currency' => 'required|min:3|max:3',
            'account_holder_name' => 'required|string',
            'account_holder_type' => 'required|string',
            'routing_number' => 'required|min:9|max:12',
            'account_number' => 'required|max:12',
        ]);

        $stripeResp = Http::asForm()
            ->withToken('sk_test_51KZo9yG6d8NW7tSt7425Hb2Bq8FTBVfVtqADD0F5Ug9OBRNre475ldk0N4zNv2b7DvdDFzZfNqE2ynnLuZEYP6gS0006PVsk8j')
            ->post('https://api.stripe.com/v1/tokens', [
                'bank_account' =>
                [
                    'country' => $country,
                    'currency' => $currency,
                    'account_holder_name' => $accountHolderName,
                    'account_holder_type' => $accountHolderType,
                    'routing_number' => $routingNumber,
                    'account_number' => $accountNumber,
                ]
            ]);

        $response = json_decode($stripeResp->body());

        try {
            $obj = new UserAccount();
            $obj->user_id = auth()->user()->id;
            $obj->resp_id = $response->id;
            $obj->resp_object = $response->object;
            $obj->bank_account_id = $response->bank_account->id;
            $obj->bank_account_object = $response->bank_account->object;
            $obj->account_holder_name = $response->bank_account->account_holder_name;
            $obj->account_holder_type = $response->bank_account->account_holder_type;
            $obj->account_type = $response->bank_account->account_type;
            $obj->bank_name = $response->bank_account->bank_name;
            $obj->country = $response->bank_account->country;
            $obj->currency = $response->bank_account->currency;
            $obj->fingerprint = $response->bank_account->fingerprint;
            $obj->last4 = $response->bank_account->last4;
            $obj->routing_number = $response->bank_account->routing_number;
            $obj->status = $response->bank_account->status;
            $obj->client_ip = $response->client_ip;
            $obj->created = $response->created;
            $obj->livemode = $response->livemode;
            $obj->type = $response->type;
            $obj->used = $response->used;
            $obj->save();

            return redirect()->route('user_account')->with('success', 'Your account crerated successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function del_payment_info(Request $r)
    {
        $id = $r->id;
        $obj = UserAccount::find($id)->delete();
        return redirect()->route('user_account')->with('success', 'Successfully deleted your account');
    }
}
