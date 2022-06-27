@extends('layouts.app')

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row right-homepage-section1">
                        <div class="col-md-12">
                            <div class="heading">
                                <h2>Your total wallet balance:
                                    ${{ number_format($wallet->user_commission, 2) }}
                                </h2>
                            </div>
                            <h3 class="text-uppercase text-info">Get your wallet balance every week</h3>

                            @if ($wallet->user_commission > 1000 || $wallet->user_commission >= 1000)
                                <form action="{{ route('credit_user_account') }}" method="post">
                                    @csrf

                                    <input type="submit" value="Credit into your account">
                                </form>
                            @else
                                <h3 class="text-uppercase text-info">Credit balance available one your mimimum wallet balance
                                    is $1000</h3>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection

@section('frontendJs')
    <script>
        jQuery(document).ready(function($) {

            function notification(resp, status) {
                new Noty({
                    theme: 'sunset',
                    type: status,
                    layout: 'topRight',
                    text: resp,
                    timeout: 3000,
                    closeWith: ['click', 'button']
                }).show();
            }

        });
    </script>
@endsection
