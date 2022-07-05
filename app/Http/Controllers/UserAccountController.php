<?php

namespace App\Http\Controllers;

use App\Models\Frontend\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserAccountController extends Controller
{
    public function index()
    {
        $uid = auth()->user()->id;
        $query = UserAccount::where('user_id', $uid)->with('account')->get();

        // Fetch country code from DB
        $countrycode = DB::table('countrycodes')->get();

        // Fetch currency code from DB
        $currency = DB::table('currency')->get();

        return view('frontend.pages.account.index', [
            'data' => $query,
            'countrycode' => $countrycode,
            'currency' => $currency
        ]);
    }

    public function create_payment_info(Request $r)
    {
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

        try {

            $stripeResp = Http::asForm()
                ->withToken('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')
                ->post('https://api.stripe.com/v1/tokens', [
                    'bank_account' =>
                    [
                        'country' => 'US',
                        'currency' => 'USD',
                        'account_holder_name' => $accountHolderName,
                        'account_holder_type' => $accountHolderType,
                        'routing_number' => $routingNumber,
                        'account_number' => $accountNumber,
                    ]
                ]);

            $response = json_decode($stripeResp->body());

            if (isset($response->id)) {

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
            } else {

                return redirect()->route('user_account')->with('error', $response->error->message);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function del_payment_info(Request $r)
    {
        $id = $r->id;
        try {
            $obj = UserAccount::find($id)->delete();
            return redirect()->route('user_account')->with('success', 'Successfully deleted your account');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
