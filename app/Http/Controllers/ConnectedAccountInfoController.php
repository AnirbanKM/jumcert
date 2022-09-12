<?php

namespace App\Http\Controllers;

use App\Models\ConnectedAccount;
use App\Models\ConnectedAccountInfo;
use Illuminate\Http\Request;

class ConnectedAccountInfoController extends Controller
{
    public function update_connected_account(Request $r)
    {
        try {
            $account = ConnectedAccount::where('user_id', auth()->user()->id)->first();
            $account_id = $account->connected_account_id;

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $res = $stripe->accounts->update(
                $account_id,
                [
                    'metadata' => ['order_id' => '6735'],
                    'business_type' => 'individual',
                    'email' => $r->email,
                    'company' => [
                        'address' => [
                            'country' => $r->company_country,
                            'state' => $r->company_state,
                            'city' => $r->company_city,
                            'line1' => $r->company_line1,
                            'line2' =>  $r->company_line2,
                            'postal_code' => $r->company_postal_code
                        ]
                    ],
                    'business_profile' => [
                        'mcc' => 5046,
                        'name' => $r->b_profile_name,
                        'product_description' =>  $r->b_profile_desc

                    ],
                    'individual' => [
                        'dob' => [
                            'day' => $r->dob_day,
                            'month' => $r->dob_month,
                            'year' => $r->dob_year
                        ],
                        'address' => [
                            'state' => $r->i_address_state,
                            'city' =>  $r->i_address_city,
                            'line1' =>  $r->i_address_line1,
                            'postal_code' => $r->i_address_postal_code
                        ],
                        'first_name' => $r->i_user_first_name,
                        'last_name' => $r->i_user_last_name,
                        'email' => $r->i_user_email,
                        'phone' => $r->i_user_Phone,
                        'ssn_last_4' => $r->i_user_ssn_last_4
                    ],
                    'tos_acceptance[date]' => strtotime("now"),
                    'tos_acceptance[ip]' => '8.8.8.8'
                ]
            );

            $obj = new ConnectedAccountInfo();

            $obj->user_id = auth()->user()->id;
            $obj->connected_account_id = $account_id;
            $obj->email = $r->email;

            $obj->company_country = $r->company_country;
            $obj->company_state = $r->company_state;
            $obj->company_city = $r->company_city;
            $obj->company_line1 = $r->company_line1;
            $obj->company_line2 = $r->company_line2;
            $obj->company_postal_code = $r->company_postal_code;

            $obj->b_profile_name = $r->b_profile_name;
            $obj->b_profile_desc = $r->b_profile_desc;

            $obj->dob_day = $r->dob_day;
            $obj->dob_month = $r->dob_month;
            $obj->dob_year = $r->dob_year;

            $obj->i_address_state = $r->i_address_state;
            $obj->i_address_city = $r->i_address_city;
            $obj->i_address_line1 = $r->i_address_line1;
            $obj->i_address_postal_code = $r->i_address_postal_code;

            $obj->i_user_first_name = $r->i_user_first_name;
            $obj->i_user_last_name = $r->i_user_last_name;
            $obj->i_user_email = $r->i_user_email;
            $obj->i_user_Phone = $r->i_user_Phone;
            $obj->i_user_ssn_last_4 = $r->i_user_ssn_last_4;

            $obj->save();

            return redirect()->route('connected_account')->with('success', 'Account Created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('connected_account')->with('error', 'Something went wrong');
        }
    }

    public function add_bank_account(Request $r)
    {
        try {
            $account = ConnectedAccount::where('user_id', auth()->user()->id)->first();
            $account_id = $account->connected_account_id;

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $res = $stripe->accounts->update(
                $account_id,
                [
                    'bank_account' => [
                        'country' => 'us',
                        'currency' => 'usd',
                        'routing_number' => $r->routing_number,
                        'account_number' => $r->account_number
                    ],
                    'tos_acceptance[date]' => strtotime("now"),
                    'tos_acceptance[ip]' => '8.8.8.8'
                ]
            );

            return $res;

            return redirect()->route('connected_account')->with('success', 'Account Created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('connected_account')->with('error', 'Something went wrong');
        }
    }
}
