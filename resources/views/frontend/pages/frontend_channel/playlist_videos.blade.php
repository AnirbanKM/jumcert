@extends('layouts.app')

<style>
    img.king {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 30px;
        height: 30px;
        padding: 3px;
    }

    .purchasedVideo {
        position: absolute;
        left: 50%;
        bottom: 35%;
        background: #0a084a;
        color: #fff;
        z-index: 5;
        padding: 2px 5px;
        border-radius: 5px;
        font-weight: 100;
        font-size: 15px;
    }
</style>

@section('content')
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
                            <h6>
                                {{ $playlist->frontendVideos()->count() }}
                                videos
                            </h6>
                            <p>{{ $playlist->desc }}</p>

                            <div class="channel-info-sec">
                                <div class="user-details">

                                    @if ($playlist->user_info == null)
                                        <img src="{{ asset('user.png') }}" class="user" alt="" />
                                    @else
                                        <img src="{{ $playlist->user_info->image }}" alt="" />
                                    @endif

                                    <div class="text">
                                        <h6>{{ $channel->user_primary->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

                        @foreach ($videos as $video)
                            <div class="col-xl-4 col-md-6">
                                <div class="each_card" style="overflow: hidden;position: relative;">

                                    @auth
                                        @if ($video->video_type == 'Public')
                                            <a href="{{ route('watch_video', $video->video_id) }}" target="_blank">
                                                <div class="thumbnail">
                                                    <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                                                </div>
                                            </a>
                                        @else
                                            @if ($video->user_id == Auth::user()->id)
                                                {{-- If Video User_id == Video Creater User ID --}}
                                                <a href="{{ route('watch_creater_video', $video->video_id) }}"
                                                    target="_blank">
                                                    <div class="thumbnail">
                                                        <img src="{{ $video->thumbnail }}" class="w-100 m-0"
                                                            alt="" />
                                                        @if ($video->video_type == 'Private')
                                                            <img src=" {{ asset('frontend/img/each_card/king.png') }}"
                                                                class="king" alt="" />
                                                        @endif
                                                    </div>
                                                </a>
                                            @elseif($video->purchasedVideo != null)
                                                {{-- if user purchased the video --}}
                                                @if ($video->purchasedVideo->user_id == Auth::user()->id)
                                                    <a href="{{ route('watch_private_video', $video->video_id) }}"
                                                        target="_blank">
                                                        <div class="thumbnail">
                                                            <img src="{{ $video->thumbnail }}" class="w-100 m-0"
                                                                alt="" />
                                                            @if ($video->video_type == 'Private')
                                                                <img src=" {{ asset('frontend/img/each_card/king.png') }}"
                                                                    class="king" alt="" />
                                                            @endif
                                                        </div>
                                                    </a>
                                                    <span class="purchasedVideo">Video is purchased</span>
                                                @else
                                                    {{-- purchase private video other users --}}
                                                    <div class="card_img" data-id="{{ $video->id }}">
                                                        {{-- video thumbnail --}}
                                                        <div class="thumbnail">
                                                            <img src="{{ $video->thumbnail }}" class="w-100 m-0"
                                                                alt="" />
                                                        </div>
                                                        @if ($video->video_type == 'Private')
                                                            <img src=" {{ asset('frontend/img/each_card/king.png') }}"
                                                                class="king" alt="" />
                                                        @endif
                                                    </div>
                                                @endif
                                            @else
                                                {{-- purchase private video other users --}}
                                                <div class="card_img" data-id="{{ $video->id }}">
                                                    {{-- video thumbnail --}}
                                                    <div class="thumbnail">
                                                        <img src="{{ $video->thumbnail }}" class="w-100 m-0"
                                                            alt="" />
                                                    </div>
                                                    @if ($video->video_type == 'Private')
                                                        <img src=" {{ asset('frontend/img/each_card/king.png') }}"
                                                            class="king" alt="" />
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    @endauth

                                    @guest
                                        {{-- purchase private video other users --}}
                                        <div class="thumbnail card_img" data-id="{{ $video->id }}">
                                            {{-- video thumbnail --}}
                                            @if ($video->video_type == 'Public')
                                                <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                                            @else
                                                <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                                                <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king"
                                                    alt="" />
                                            @endif
                                        </div>
                                    @endguest

                                    <div class="top">
                                        <h3>{{ $video->title }}
                                            <span> {{ $video->created_at->diffForHumans() }}</span>
                                        </h3>
                                    </div>
                                    <div class="down">
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')

    {{-- Modal for purchase private videos --}}
    <div class="modal fade" id="privateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        This is a private video
                    </h4>
                    <button type="button" class="privateModalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @guest('web')
                        <p class="text-center">
                            Login to Jumcert account with your credentials
                        </p>
                        <button class="btn btn-primary" id="loginJumcertBtn" style="display: table;margin: 0 auto;">
                            Login to Jumcert
                        </button>
                    @endguest

                    @auth('web')
                        <p class="text-center" style="margin-bottom: 15px;">
                            This is a private video, you need to purchase this video
                        </p>
                        <form action="{{ route('private_video_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="vId" id="vId" />
                            <input type="submit" class="btn btn-primary" value="Purchase this video"
                                style="display: table;margin: 0 auto;" />
                        </form>
                    @endauth

                </div>
            </div>
        </div>
    </div>
@endsection

@section('frontendJs')
    <script>
        jQuery(document).ready(function($) {
            function notification(resp, status) {
                new Noty({
                    theme: 'sunset',
                    type: status,
                    layout: 'topRight',
                    text: resp,
                    timeout: 3000,
                    closeWith: ['click', 'button']
                }).show();
            }

            $('body').on('click', '.card_img', function(e) {

                var id = $(this).data('id');
                $('#vId').val(id);
                $('#privateModal').addClass('show').css('display', 'block');
            });

            $(".privateModalClose").click(function(event) {

                $('#privateModal').removeClass('show').css('display', 'none');
            });

        })
    </script>
@endsection
