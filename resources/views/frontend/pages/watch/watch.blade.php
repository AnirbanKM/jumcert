@extends('layouts.app')

@section('content')
    <section class="page_content stream-player-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    @if ($video != null)
                        {{-- watch video main start --}}
                        <div class="right-works-section2 row">
                            <div class="col-md-12">

                                @if ($video->videoname != null)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video controls>
                                            <source src="{{ $video->videoname }}" type="video/webm">
                                            <source src="{{ $video->videoname }}" type="video/mp4">
                                        </video>
                                    </div>
                                @else
                                    <img src="{{ $video->thumbnail }}" alt="" width="100%" />
                                @endif

                                <div class="video_info">
                                    <h3>
                                        <img src="{{ $video->user_info->image }}" alt=""
                                            style="width: 50px;height: 50px;border-radius: 100%;object-fit: cover;margin-right: 10px;" />
                                        <span>{{ $video->title }}</span>
                                    </h3>

                                </div>
                            </div>
                        </div>
                        {{-- watch video main end --}}

                        <div class="video_desc mb-5">
                            <h3 class="title">{{ $video->title }}</h3>
                            <p> {{ $video->desc }} </p>
                        </div>
                    @else
                        <h1 class="text-uppercase text-warning">
                            This private video not found.
                        </h1>
                    @endif

                </div>

            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
