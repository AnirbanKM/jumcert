@extends('layouts.app')

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="right-homepage-section1">
                        <div class="heading mb-4">
                            <h2>Your current subscription details</h2>
                        </div>
                    </div>

                    <div class="subscription-info">
                        <h1 class="text-dark text-uppercase mb-3">Your are currently using :
                            @if (Auth::user()->user_role == 0)
                                Free Plan
                            @elseif (Auth::user()->user_role == 1)
                                Pro Plan
                            @else
                                business Plan
                            @endif
                        </h1>

                        @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2)
                            <h2 class="text-uppercase">
                                You plan validity till : {{ $plan_end_date }}
                            </h2>
                            <h2>{{ $total_days }} Days left!!!</h2>
                        @else
                            <h3>You are currently using free plan please upgrade your plan</h3>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
