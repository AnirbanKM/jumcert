@extends('layouts.app')

@section('frontendCss')
    <style>
        .best_pick .row {
            align-items: center;
        }

        .best_pick video {
            width: 100%;
            border: 2px solid #ff7f11;
            border-radius: 5px;
            height: fit-content;
        }

        .purchasedVideo {
            position: absolute;
            left: 50%;
            bottom: 27%;
            background: #0a084a;
            color: #fff;
            z-index: 5;
            padding: 2px 5px;
            border-radius: 5px;
            font-weight: 100;
            font-size: 15px;
        }

        h6.unseen {
            font-size: 10px;
            background: green;
            border-radius: 50%;
            padding: 5px;
            line-height: 5px;
        }

        a.dislikevideo {
            color: #1c1c1c !important;
        }

        nav {
            width: 100%;
        }

        ul.pagination {
            justify-content: center;
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

                        @foreach ($videos as $video)
                            <div class="col-xl-4 col-md-6">

                                {{-- prive video --}}
                                <div class="each_card">

                                    <div class="top">
                                        <h3>
                                            <img src="{{ $video->user_info->image }}" class="user" alt="" />
                                            {{ $video->title }}
                                            <span>{{ $video->created_at->format('M d, Y') }}</span>
                                        </h3>
                                    </div>

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
                                                        <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
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

                                    <div class="down">
                                        <ul>
                                            {{-- Like --}}
                                            <li>
                                                @auth
                                                    @php
                                                        $str = $video->checkLikeByUser;
                                                        $arr = explode(',', $str);
                                                        $authUserID = auth()->user()->id;
                                                        $checkAuthUser = in_array($authUserID, $arr);
                                                        if ($checkAuthUser == true) {
                                                            $addClass = 'dislikevideo';
                                                        } else {
                                                            $addClass = 'likevideo';
                                                        }
                                                    @endphp

                                                    <a href="javascript:void(0)" class={{ $addClass }}
                                                        id="like{{ $video->id }}" data-vid="{{ $video->id }}">
                                                        <i class="fas fa-thumbs-up"></i>
                                                        <span id="likeCount{{ $video->id }}">
                                                            {{ $video->countlike }}
                                                        </span> Like
                                                    </a>

                                                @endauth

                                                @guest
                                                    <a href="javascript:void(0)" class="card_img">
                                                        <i class="fas fa-thumbs-up"></i>
                                                        <span>{{ $video->countlike }}</span> Like
                                                    </a>
                                                @endguest
                                            </li>

                                            {{-- Chat --}}
                                            <li>
                                                @auth
                                                    @if ($video->user_id == Auth::user()->id)
                                                        <a href="javascript:void(0)" class="videoOwner"
                                                            data-vid="{{ $video->id }}">
                                                            <i class="fas fa-comment-dots"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" class="eachReqModal"
                                                            data-vid="{{ $video->id }}">
                                                            <i class="fas fa-comment-dots"></i>
                                                        </a>
                                                    @endif
                                                @endauth

                                                @guest
                                                    <a href="javascript:void(0)" class="showLogin">
                                                        <i class="fas fa-comment-dots"></i>
                                                    </a>
                                                @endguest
                                            </li>

                                            {{-- Share video link --}}
                                            <li>
                                                @auth
                                                    @if ($video->video_type === 'Public')
                                                        <a href="javascript:void(0)" class="publicLink"
                                                            data-id="{{ $video->id }}">
                                                            <i class="fas fa-share-alt"></i>
                                                            Share
                                                        </a>
                                                    @else
                                                        <a href="javascript:;" class="{{ $video->video_type }}">
                                                            <i class="fas fa-share-alt"></i>
                                                            Share
                                                        </a>
                                                    @endif
                                                @endauth

                                                @guest
                                                    <a href="javascript:void(0)" class="card_img">
                                                        <i class="fas fa-share-alt"></i>
                                                        Share
                                                    </a>
                                                @endguest
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>

                    {!! $videos->links() !!}
                </div>
            </div>
        </div>
    </section>

    <section class="best_pick homepage-section2">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-6">
                    <video controls muted>
                        <source src="{{ asset('intro.mp4') }}" type="video/mp4">
                    </video>
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="right_content">
                        <h2>Best pick for hassle-free Video experience.</h2>
                        <ul>
                            <li>
                                <h5>
                                    <img src="{{ asset('frontend/img/best_pick/l1.png') }}" class="mw-100"
                                        alt="" />
                                    Access while traveling
                                    <span>
                                        It is a long established fact that a reader will be
                                        distracted by the readable content.
                                    </span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    <img src="{{ asset('frontend/img/best_pick/l2.png') }}" class="mw-100"
                                        alt="" />
                                    Watch with no interruptions
                                    <span>
                                        It is a long established fact that a reader will be
                                        distracted by the readable content.
                                    </span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    <img src="{{ asset('frontend/img/best_pick/l3.png') }}" class="mw-100"
                                        alt="" />
                                    Explore with no interruptions
                                    <span>
                                        It is a long established fact that a reader will be
                                        distracted by the readable content.
                                    </span>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="videos_sec common homepage-section3">
        <div class="container">
            <h6>Latest Uploads</h6>
            <h5>Popular Videos</h5>
            <div class="row">

                <div class="col-lg col-md-4 col-sm-6 each_video">
                    <img src="{{ asset('frontend/img/popular/img_1.png') }}" class="w-100" alt="" />
                    <h6>Latest Uploads</h6>
                    <h5>Soviet : The Cold War</h5>
                </div>

                <div class="col-lg col-md-4 col-sm-6 each_video">
                    <img src="{{ asset('frontend/img/popular/img_1.png') }}" class="w-100" alt="" />
                    <h6>Latest Uploads</h6>
                    <h5>Soviet : The Cold War</h5>
                </div>

                <div class="col-lg col-md-4 col-sm-6 each_video">
                    <img src="{{ asset('frontend/img/popular/img_1.png') }}" class="w-100" alt="" />
                    <h6>Latest Uploads</h6>
                    <h5>Soviet : The Cold War</h5>
                </div>

                <div class="col-lg col-md-4 col-sm-6 each_video">
                    <img src="{{ asset('frontend/img/popular/img_1.png') }}" class="w-100" alt="" />
                    <h6>Latest Uploads</h6>
                    <h5>Soviet : The Cold War</h5>
                </div>

                <div class="col-lg col-md-4 col-sm-6 each_video">
                    <img src="{{ asset('frontend/img/popular/img_1.png') }}" class="w-100" alt="" />
                    <h6>Latest Uploads</h6>
                    <h5>Soviet : The Cold War</h5>
                </div>

                <div class="col-lg col-md-4 col-sm-6 each_video">
                    <img src="{{ asset('frontend/img/popular/img_1.png') }}" class="w-100" alt="" />
                    <h6>Latest Uploads</h6>
                    <h5>Soviet : The Cold War</h5>
                </div>

                <div class="col-lg col-md-4 col-sm-6 each_video">
                    <img src="{{ asset('frontend/img/popular/img_1.png') }}" class="w-100" alt="" />
                    <h6>Latest Uploads</h6>
                    <h5>Soviet : The Cold War</h5>
                </div>

            </div>
        </div>
    </section>

    <section class="process_sec common homepage-section4">
        <div class="container sec_bg" style="background-image: url({{ asset('frontend/img/bg.png') }})">
            <h6>LATEST UPLOADS
            </h6>
            <h5>Popular Videos</h5>
            <div class="row">
                <div class="col-lg-4 col-md-6 each_process">
                    <img src="{{ asset('frontend/img/process/register.png') }}" alt="" />
                    <h6>Register</h6>
                    <p>
                        Keep access to your entertainment content while roaming the
                        world.Pick from thousands.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 each_process">
                    <img src="{{ asset('frontend/img/process//upload.png') }}" alt="" />
                    <h6>Register</h6>
                    <p>
                        Keep access to your entertainment content while roaming the
                        world.Pick from thousands.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 each_process">
                    <img src="{{ asset('frontend/img/process/explore.png') }}" alt="" />
                    <h6>Register</h6>
                    <p>
                        Keep access to your entertainment content while roaming the
                        world.Pick from thousands.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')

    @auth
        {{-- Modal for private videos sharing alert --}}
        <div class="modal fade" id="privateVideoSharemodal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <p class="text-center" style="margin: 0px;">
                            This is a Private Video, link share is not available
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal for public videos sharing link --}}
        <div class="modal fade" id="publicVideoSharemodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Share
                        </h4>
                        <button type="button" class="privateModalClose" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <ul class="social-share">
                            <li>
                                <a href="" id="facebook" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" id="whatsapp" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="copy-link">
                            <p class="text-center copyText" id="publicVideoURL" style="margin: 0px;"></p>
                        </div>
                        <button class="copy-btn" type="button">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection

@section('frontendJs')
    <script>
        jQuery(document).ready(function($) {

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
                $('#privateVideoSharemodal').removeClass('show').css('display', 'none');
                $('#publicVideoSharemodal').removeClass('show').css('display', 'none');
            });

            @auth
            // ***Generate link for public video function
            $("body").on('click', '.publicLink', function(e) {

                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('public_video_link') }}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        vid: id
                    },
                    success: function(resp) {
                        console.log(resp);
                        $('#publicVideoURL').html(resp.path);
                        $("#publicVideoSharemodal").addClass('show').css('display', 'block');
                        $('#facebook').attr('href', resp.fb);
                        $('#whatsapp').attr('href', resp.wp);
                    }
                });
            });

            $(".copy-btn").click(function() {
                var temp = $("<input>");
                $("body").append(temp);
                temp.val($('#publicVideoURL').text()).select();
                document.execCommand("copy");
                temp.remove();
                $(this).text("Copied!");
                $(this).css({
                    color: '#fff',
                    background: '#1c1c1c',
                });
            });

            // ***Like videos
            $("body").on('click', '.likevideo', function(e) {

                var id = $(this).data('vid');

                $.ajax({
                    url: "{{ route('video_like') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp);

                        if (resp.status === 'liked') {
                            $('#like' + id).addClass('dislikevideo').removeClass('likevideo');
                            $('#likeCount' + id).text(resp.count);
                        } else {
                            $('#like' + id).addClass('likevideo').removeClass('dislikevideo');
                            $('#likeCount' + id).text(resp.count);
                        }
                    }
                })
            });

            // ***Dislike videos
            $("body").on('click', '.dislikevideo', function(e) {

                var id = $(this).data('vid');

                $.ajax({
                    url: "{{ route('video_dislike') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp);

                        if (resp.status === 'disliked') {
                            $('#like' + id).addClass('likevideo').removeClass('dislikevideo');
                            $('#likeCount' + id).text(resp.count);
                        } else {
                            $('#like' + id).addClass('dislikevideo').removeClass('likevideo');
                            $('#likeCount' + id).text(resp.count);
                        }
                    }
                })
            });
        @endauth

        // ***ALert funtionality for Private Video Share
        $("body").on('click', '.Private', function(e) {

            $("#privateVideoSharemodal").addClass('show').css('display', 'block');
        })

        });
    </script>
@endsection
