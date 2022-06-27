@extends('layouts.app')

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content about-section1 price_plan-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="row">

                        {{-- Free Plan --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-head">
                                    <h5>Starter <div></div>
                                    </h5>
                                    <h5>Free <span>Free Sign-Up </span></h5>

                                </div>
                                <h6>Plan Includes</h6>
                                <ul>
                                    <li>Access to Jumcert</li>
                                    <li>Access to Event Library</li>
                                    <li>Pay-Per-View</li>
                                    <li>Chat/Message Feature</li>

                                </ul>
                                <a href="javascript:void(0)">View All Details</a>
                                @if (auth()->user()->user_role == 0)
                                    <a class="card-btn" href="javascript:void(0)" style="background-color: #060447">
                                        Current Plan
                                    </a>
                                @else
                                    <a class="card-btn"
                                        href="{{ route('default_user', [base64_encode(auth()->user()->user_role), base64_encode('Free')]) }}">
                                        Choose Package
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Pro Plan --}}
                        <div class="col-md-4">
                            <div class="card middle-card">
                                <div class="card-head">
                                    <h5>Pro <div></div>
                                    </h5>
                                    <h5>$19.00/Mon</h5>

                                </div>
                                <h6>Plan Includes</h6>
                                <ul>
                                    <li>Starter plan plus</li>
                                    <li>Broadcast 1 to 1 Hosting</li>
                                    <li>Moderate Chat/Message Feature</li>
                                    <li>Create Profile Channel </li>

                                </ul>
                                <a href='javascript:void(0)'>View All Details</a>
                                @if (auth()->user()->user_role == 1)
                                    <a class="card-btn" href="javascript:void(0)">
                                        Current Plan
                                    </a>
                                @else
                                    <a class="card-btn"
                                        href="{{ route('payments', [base64_encode(19), base64_encode(auth()->user()->user_role), base64_encode('Pro')]) }}">
                                        Choose Package
                                    </a>
                                @endif

                            </div>
                        </div>

                        {{-- Business Plan --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-head">
                                    <h5>Business<div></div>
                                    </h5>
                                    <h5>$44.99/Mon</h5>
                                </div>
                                <h6>Plan Includes</h6>
                                <ul>
                                    <li>A Pro plan plus</li>
                                    <li>Create Profile Channel </li>
                                    <li>Create Profile Channel </li>
                                    <li>Create Profile Channel </li>
                                </ul>
                                <a href="#">View All Details</a>

                                @if (auth()->user()->user_role == 2)
                                    <a class="card-btn" href="javascript:void(0)" style="background-color: #060447">
                                        Current Plan
                                    </a>
                                @else
                                    <a class="card-btn"
                                        href="{{ route('payments', [base64_encode(50), base64_encode(auth()->user()->user_role), base64_encode('Business')]) }}">
                                        Choose Package
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
