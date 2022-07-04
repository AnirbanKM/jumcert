@extends('layouts.app')

@section('frontendCss')
    <style>
        .req-card {
            box-shadow: 0 2px 10px 2px rgb(0 0 0 / 20%);
            padding-bottom: 18px;
            border-radius: 4px;
        }

        .each_card .request-part {
            padding: 1rem 1rem 0;
        }

        .each_card .request-part h3 {
            font-size: 16px;
            color: #333;
        }

        .each_card .request-part ul {
            margin: 0;
            padding: 0;
            display: flex;
            gap: 2rem;
            align-items: center;
            margin-top: 1rem;
        }

        .each_card .accept {
            background-color: rgb(255 127 17);
            color: #fff;
            padding: 0.5rem 2rem;
            border-radius: 4px;
        }

        .each_card .reject {
            background-color: rgb(10 8 74);
            color: #fff;
            padding: 0.5rem 2rem;
            border-radius: 4px;
        }

        form input[type="submit"] {
            border: none;
        }
    </style>
@endsection

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content homepage-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="row right-homepage-section1">

                        @if (count($chatRequests) > 0)
                            @foreach ($chatRequests as $item)
                                <div class="col-xl-4 col-md-6">
                                    <div class="each_card req-card">
                                        <div class="top">
                                            <h3>
                                                @if ($item->userProfile == null)
                                                    <img src="{{ asset('frontend/img/user.png') }}" class="user"
                                                        alt="" />
                                                @else
                                                    <img src="{{ $item->userProfile->image }}" class="user"
                                                        alt="" />
                                                @endif

                                                {{ $item->userinfo->name }}
                                                <span> {{ $item->created_at->diffForHumans() }}</span>
                                            </h3>
                                        </div>
                                        <div class="request-part">
                                            <h3>You have a chat request :</h3>
                                            <ul>
                                                <li>
                                                    <form action="{{ route('update_chat_req') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="cid" value="{{ $item->id }}" />
                                                        <input type="hidden" name="status" value="Active" />
                                                        <input type="submit" class="accept" value="Accept">
                                                    </form>

                                                </li>
                                                <li>
                                                    <form action="{{ route('update_chat_req') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="cid" value="{{ $item->id }}" />
                                                        <input type="hidden" name="status" value="Inactive" />
                                                        <input type="submit" class="reject" value="Reject">
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h2>Currently you don't have any chat request.</h2>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>



    @include('frontend.inc.startsec')
@endsection

@section('frontendJs')
    <script>
        jQuery(document).ready(function($) {


        });
    </script>
@endsection
