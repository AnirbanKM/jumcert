@extends('layouts.app')

<style>
    .channelErr {
        color: #1c1c1c;
        margin: 0 auto;
        text-transform: uppercase;
    }
</style>

@section('content')
    <section class="page_content connections-section1 videos-section1 channel-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9 right-homepage-section1">

                    <div class="heading">
                        <h2>Search Channels here</h2>
                    </div>

                    <div class="row rounded right-connections-section1 right-videos-section1 right-channel-section1">

                        @if (count($channels) > 0)
                            @foreach ($channels as $channel)
                                <div class="col-xl-4 col-md-6 channel-card">
                                    <div class="each_card ">

                                        <img class="channel-img" src="{{ $channel->image }}" alt="">

                                        <div class="top channel-top">
                                            @if ($channel->user_info == null)
                                                <img src="{{ asset('user.png') }}" class="user" alt="" />
                                            @else
                                                <img src="{{ $channel->user_info->image }}" class="user"
                                                    alt="" />
                                            @endif

                                            <h3>{{ $channel->name }} </h3>
                                            <a href="{{ route('frontend_channel', $channel->slug) }}" class="sub-now">
                                                View Channel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1 class="channelErr">No channel found</h1>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
