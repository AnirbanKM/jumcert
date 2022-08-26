<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StripeTopupCorn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe_topup:corn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stripe Payout Balance check every 5 minutes and Topup account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $bal = $stripe->balance->retrieve();
        $payOutAmount = (int)$bal->available[0]->amount ?? null;

        if ($payOutAmount <= 10000) {

            $res = $stripe->topups->create(
                [
                    'amount' => 20000,
                    'currency' => 'usd',
                    'description' => 'Top-up for week of ' . date('Y-m-d'),
                    'statement_descriptor' => 'Weekly top-up',
                ]
            );
            Log::info($res);
        } else {
            Log::info(" *** Sufficient account balance *** ");
        }
    }
}
