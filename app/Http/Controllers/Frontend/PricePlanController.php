<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment\Payment;
use App\Models\Payment\Order;
use App\Models\User;

class PricePlanController extends Controller
{
    public function index()
    {
        return view('frontend.pages.price_plan');
    }

    public function payments(Request $request, $price, $currentPlan, $planName)
    {
        $price = base64_decode($price);
        $currentPlan = base64_decode($currentPlan);
        $planName = base64_decode($planName);

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
        ]);
        $intent = $payment_intent->client_secret;
        return view('frontend.pages.payment.checkout', [
            'intent' => $intent,
            'price' => $price,
            'currentPlan' => $currentPlan,
            'planName' => $planName
        ]);
    }

    public function payment_process(Request $r)
    {
        $user = auth()->user()->id;
        $currentPlan = $r->currentPlan; // not using currently

        $payment_id = $r->payment_id;
        $client_secret = $r->client_secret;
        $payment_method = $r->payment_method;
        $status = $r->status;
        $planName = $r->planName;
        $price = $r->price;

        try {
            $payment = new Payment();
            $payment->payment_id = $payment_id;
            $payment->user_id = $user;
            $payment->client_secret = $client_secret;
            $payment->payment_method = $payment_method;
            $payment->status = $status;
            $payment->save();

            $order = new Order();
            $order->plan_name = $planName;
            $order->price = $price;
            $order->payment_id = $payment->id;
            $order->user_id = auth()->user()->id;
            $order->save();

            // Status update
            if ($payment->id != "") {
                $query = Payment::find($payment->id);
                $query->status = "Success";
                $query->update();

                $user = User::find($user);
                if ($planName == "Pro") {
                    $p = "1";
                } else if ($planName == "Business") {
                    $p = "2";
                } else {
                    $p = "0";
                }
                $user->stream_role = 'host';
                $user->user_role = $p;
                $user->upgradationDate = time();
                $user->update();
            } else {
                $user = User::find($user);
                $user->user_role = 0;
                $user->update();
            }
            return response()->json($p);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function default_user($currentPlan, $planName)
    {
        $user = auth()->user()->id;
        $currentPlan = base64_decode($currentPlan);
        $planName = base64_decode($planName);

        if ($planName == "Free") {
            try {
                $user = User::find($user);
                $user->user_role = 0;
                $user->update();

                return redirect()->route('price_plan')->with('success', 'Plan changed successfully');
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            return redirect()->route('price_plan')->with('error', 'something went wrong');
        }
    }

    public function success()
    {
        return view('frontend.pages.successfull');
    }
}
