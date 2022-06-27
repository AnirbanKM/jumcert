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

                        <h2 class="text-uppercase">
                            @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2)
                                You are plan validity is 28 days
                            @else
                                You are cuurently using free plan please upgrade your plan
                            @endif
                        </h2>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
