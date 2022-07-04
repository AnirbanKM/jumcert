@extends('layouts.app')

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content connections-section1 videos-section1 channel-section1 user-channel-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row rounded right-videos-section1 right-channel-section1 right-user-channel-section1">

                        <div class="col-md-4">
                            <img class="main" src="{{ $playlist->image }}" alt="" />
                        </div>

                        <div class="col-md-8">
                            <h2>{{ $playlist->title }}</h2>
                            <h6>{{ $playlist->videos()->count() }} videos, 0 views, Last updated on
                                {{ $playlist->updated_at->diffForHumans() }}</h6>
                            <p>{{ $playlist->desc }}</p>

                            <div class="channel-info-sec">
                                <div class="user-details">
                                    <img src="{{ $playlist->user_info->image }}" alt="">
                                    <div class="text">
                                        <h6>Bessie Cooper</h6>
                                        <p class="d-none">15.3M subscribers</p>
                                    </div>
                                </div>
                                <button>Following</button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

                        @foreach ($videos as $video)
                            <div class="col-xl-4 col-md-6">
                                <div class="each_card ">
                                    <img src="{{ $video->thumbnail }}" class="w-100" alt="" />
                                    <div class="top">
                                        <h3>{{ $video->title }}
                                            <span> {{ $video->created_at->diffForHumans() }}</span>
                                        </h3>
                                    </div>
                                    <div class="down">
                                        <ul class="d-none">
                                            <li class="like"><a href="#"><i class="fas fa-thumbs-up"></i>0
                                                    Likes</a>
                                            </li>
                                            <li><a href="#"><i class="fas fa-eye"></i> 0 Views</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
