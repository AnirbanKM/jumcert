@extends('layouts.app')

<style>
    .channel-info-sec h6 {
        color: #000;
        text-align: left;
        font-size: 30px;
    }

    .channel-info-sec p {
        color: #000;
        text-align: justify;
        margin-top: 10px;
    }

    .channel-info-sec {
        margin-top: 30px;
    }

    form input.join {
        background-color: #0a084a;
        color: #fff;
        padding: 13px 33px;
        font-size: 16px;
        border-radius: 8px;
        font-weight: 600;
        margin-top: 20px;
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
                    <img src="{{ $stream->thumbnail }}" class="w-100" alt="" />

                    <div class="channel-info-sec">
                        <div class="row">
                            <div class="col-lg-12 text-box">
                                <h6> {{ $stream->topic }} </h6>
                                <p> {{ $stream->description }} </p>
                            </div>
                            <div class="col-lg-12">
                                <form action="{{ route('audience_join_stream') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="streamId" value="{{ $stream->meetingId }}">
                                    <input type="submit" class="join" value="Join stream">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
