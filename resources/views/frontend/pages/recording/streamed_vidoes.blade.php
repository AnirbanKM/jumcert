@extends('layouts.app')

<style>
    .nav-tabs a {
        color: #1c1c1c !important;
    }

    .nav-tabs a.active {
        color: #043df8 !important;
    }

    .videoPlayBtn {
        display: table !important;
        margin: 0 auto !important;
    }
</style>

@section('content')
    <section class="page_content stream-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row right-stream-section1">

                        <div class="col-md-12 right-homepage-section1">
                            <div class="heading">
                                <h2>My streamed videos </h2>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" data-toggle="tab" href="#nav-video">Videos</a>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-video">
                                    <div class="py-3">
                                        <div class="row">

                                            @foreach ($streamVideos as $item)
                                                <div class="col-md-4">
                                                    <div class="each_card">
                                                        <div class="thumbnail">
                                                            <img class="card-img-top"
                                                                src="{{ $item->streamInfo->thumbnail }}"
                                                                alt="Card image cap">
                                                        </div>
                                                        <div class="top">
                                                            <h3 class="card-title pl-0">
                                                                {{ $item->streamInfo->topic }} <br />
                                                                <span>
                                                                    {{ $item->created_at->diffForHumans() }}
                                                                </span>
                                                            </h3>
                                                            <a href="{{ route('watch_stream', ['recorded_stream_id' => $item->id]) }}"
                                                                target="_blank" class="btn btn-primary videoPlayBtn">
                                                                View Stream
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        });
    </script>
@endsection
