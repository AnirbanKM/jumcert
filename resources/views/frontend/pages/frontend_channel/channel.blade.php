@extends('layouts.app')

<style>
    .channel-section1 .right-channel-section1 .channel-info-sec .user-details img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }

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
    <section class="page_content connections-section1 videos-section1 channel-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row rounded right-connections-section1 right-videos-section1 right-channel-section1">

                        {{-- Channel Top Area Start --}}
                        <div class="col-md-12">
                            <img class="cover" src="{{ $channel->image }}" alt="">
                            <div class="channel-info-sec">
                                <div class="user-details">
                                    {{-- <img src="{{ $userinfo[0]->image }}" alt="" /> --}}

                                    @if ($channel->user_info == null)
                                        <img src="{{ asset('user.png') }}" class="user" alt="" />
                                    @else
                                        <img src="{{ $userinfo[0]->image }}" class="user" alt="" />
                                    @endif

                                    <div class="text">
                                        <h6 class="mb-0">{{ $channel->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Channel Top Area End --}}

                        {{-- Channel Tab video, Playlist, Channel Start --}}
                        <div class="col-md-12">
                            <ul class="nav tab-section" id="myTab" role="tablist">
                                <li>
                                    <a class="nav-link active" id="videos-tab" data-toggle="tab" href="#videos"
                                        role="tab" aria-controls="videos" aria-selected="true">Videos</a>
                                </li>
                                <li>
                                    <a class="nav-link" id="playlist-tab" data-toggle="tab" href="#playlist" role="tab"
                                        aria-controls="playlist" aria-selected="false">Playlist</a>
                                </li>
                                <li>
                                    <a class="nav-link" id="channel-tab" data-toggle="tab" href="#channel" role="tab"
                                        aria-controls="channel" aria-selected="false">Channel</a>
                                </li>
                            </ul>
                        </div>
                        {{-- Channel Tab video, Playlist, Channel End --}}

                        <div class="tab-content" id="myTabContent">

                            {{-- Channel Videos --}}
                            <div class="tab-pane fade show active" id="videos" role="tabpanel" aria-labelledby="videos">
                                <div class="row">

                                    @foreach ($videos as $video)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="each_card" style="overflow: hidden;position: relative;">

                                                @auth
                                                    @if ($video->video_type == 'Public')
                                                        <a href="{{ route('watch_video', $video->video_id) }}"
                                                            target="_blank">
                                                            <div class="thumbnail">
                                                                <img src="{{ $video->thumbnail }}" class="w-100 m-0"
                                                                    alt="" />
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
                                                            <img src="{{ $video->thumbnail }}" class="w-100 m-0"
                                                                alt="" />
                                                        @else
                                                            <img src="{{ $video->thumbnail }}" class="w-100 m-0"
                                                                alt="" />
                                                            <img src=" {{ asset('frontend/img/each_card/king.png') }}"
                                                                class="king" alt="" />
                                                        @endif
                                                    </div>
                                                @endguest

                                                <div class="top">
                                                    <h3>{{ $video->title }}
                                                        <span> {{ $video->created_at->diffForHumans() }} </span>
                                                    </h3>
                                                </div>
                                                <div class="down">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            {{-- Channel Playlist --}}
                            <div class="tab-pane fade" id="playlist" role="tabpanel" aria-labelledby="playlist">
                                <div class="row">
                                    @foreach ($playlists as $playlist)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="each_card ">
                                                <img src="{{ $playlist->image }}" class="w-100" alt="">
                                                <div class="top playlist-top">
                                                    <h3> {{ $playlist->title }}
                                                        <span>
                                                            @if ($playlist->frontendVideos()->count() > 10)
                                                                10 +
                                                            @else
                                                                {{ $playlist->frontendVideos()->count() }}
                                                            @endif
                                                        </span>
                                                    </h3>

                                                    <a href="{{ route('channel_playlist', ['slug' => $channel->slug, 'pid' => $playlist->id]) }}"
                                                        class="view-playlist">
                                                        View Full Playlist
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Related Channel --}}
                            <div class="tab-pane fade" id="channel" role="tabpanel" aria-labelledby="channel">
                                <div class="row">

                                    @foreach ($channels as $channel)
                                        <div class="col-xl-4 col-md-6 channel-card">
                                            <div class="each_card ">

                                                <img class="channel-img" src="{{ $channel->image }}" alt="">
                                                <div class="top channel-top">

                                                    @if ($channel->user_info == null)
                                                        <img src="{{ asset('user.png') }}" class="user"
                                                            alt="" />
                                                    @else
                                                        <img src="{{ $channel->user_info->image }}" class="user"
                                                            alt="" />
                                                    @endif

                                                    <h3>{{ $channel->name }}
                                                        <span>0 subscribers</span>
                                                    </h3>
                                                    <a href="{{ route('frontend_channel', $channel->slug) }}"
                                                        class="sub-now">View Channel</a>
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
    </section>

    @include('frontend.inc.startsec')

    {{-- Modal for private videos --}}
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

            $('#loginJumcertBtn').click(function() {
                $('#privateModal').removeClass('show').css('display', 'none');
                $('#smallModal').addClass('show').css('display', 'block');
            });

            $(".privateModalClose").click(function(event) {

                $('#privateModal').removeClass('show').css('display', 'none');
            });
        })
    </script>
@endsection
