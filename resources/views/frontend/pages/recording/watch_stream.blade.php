@extends('layouts.app')

@section('content')
    <section class="page_content stream-player-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    @if ($recordedStreamObj != null)
                        {{-- streamed video main start --}}
                        <div class="right-works-section2 row">
                            <div class="col-md-12">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video width="320" height="240" controls>
                                        <source src="{{ $recordedStreamObj->video_path }}" type="video/mp4">
                                    </video>
                                </div>

                                <div class="video_info">
                                    <h3>
                                        <img src="{{ $recordedStreamObj->channerOwnerInfo->image }}" alt=""
                                            style="width: 50px;height: 50px;border-radius: 100%;object-fit: cover;margin-right: 10px;" />
                                        <span>
                                            {{ $recordedStreamObj->channerOwnerInfo->name }}
                                        </span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        {{-- streamed video main end --}}

                        <div class="video_desc mb-5">
                            <h3 class="title">{{ $recordedStreamObj->streamInfo->topic }}</h3>
                        </div>
                    @else
                        <h1 class="text-uppercase text-warning">Stream not found.</h1>
                    @endif

                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
