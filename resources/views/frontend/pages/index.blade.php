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

    {{-- Modal for if User == Channel Owner --}}
    <div class="modal fade" id="videoOwnerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        This is a private video
                    </h4>
                    <button type="button" class="videoOwnerModalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center" style="margin-bottom: 15px;">
                        You are the owner of the video,
                        the go the Chat request section & view chat requests.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @auth
        {{-- Modal for chat request with Channel Owner --}}
        <div class="modal fade popup-modal" id="chatModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Chat box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="sendChatReq">
                        @csrf
                        <input type="hidden" id="vid" name="vid" />
                        <div class="chat-box__input">
                            <input type="text" name="msg" placeholder="send message" />
                            <input type="submit"
                                style="background-image: url({{ asset('frontend/img/chatreq.svg') }}); font-size: 0;">
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                $('#privateVideoSharemodal').removeClass('show').css('display', 'none');
                $('#publicVideoSharemodal').removeClass('show').css('display', 'none');
            });

            $('body').on('click', '.eachReqModal', function(e) {
                var vid = $(this).data('vid');
                $('#vid').val(vid);
                $("#chatModal").addClass('show').css('display', 'block');
            });

            // Send chat request to the channel owner
            $('body').on('submit', '#sendChatReq', function(e) {
                e.preventDefault();

                var form = $("#sendChatReq");

                $.ajax({
                    url: "{{ route('send_chat_req') }}",
                    type: "POST",
                    dataType: "json",
                    data: form.serialize(),
                    success: function(resp) {
                        // console.log(resp);
                        if (resp.status == 'error') {
                            $("#sendChatReq")[0].reset();
                            $("#chatModal").removeClass('show').css('display', 'none');

                            var statusparam = resp.status;
                            var msgparam = resp.msg;
                            notification(msgparam, statusparam)
                        } else {
                            $("#chatModal").removeClass('show').css('display', 'none');
                            $("#sendChatReq")[0].reset();

                            var statusparam = resp.status;
                            var msgparam = resp.msg;
                            notification(msgparam, statusparam)
                        }
                    }
                });
            });

            // Popup login Modal
            $('.showLogin').click(function() {

                $('#privateModal').addClass('show').css('display', 'block');
            });

            // Popup Modal for those who are the owner of the video
            $('.videoOwner').click(function() {

                $('#videoOwnerModal').addClass('show').css('display', 'block');
            });

            // Close videoOwner Modal
            $(".videoOwnerModalClose").click(function(event) {

                $('#videoOwnerModal').removeClass('show').css('display', 'none');
            });

            @auth
            //List All Frinds chat List
            setInterval(function() {
                getFrindsList()
            }, 5000);
            getFrindsList();

            function getFrindsList() {
                $.ajax({
                    url: "{{ route('frinds_list') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(resp) {
                        // console.log(resp);
                        $('#friends_list').html(resp.myFriends);
                    }
                })
            }

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

        // Click On Friend Name || Receiver Name
        $("body").on('click', '.chatM', function(e) {
            e.preventDefault();

            var id = $(this).data('rid');
            var sid = $(this).data('sid');
            var vid = $(this).data('vid');
            var vownerid = $(this).data('vownerid');

            $.ajax({
                url: "{{ route('get_all_msg') }}",
                type: "POST",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    friendId: id,
                    senderId: sid,
                    videoId: vid,
                    vownerid: vownerid
                },
                success: function(resp) {
                    // ***List User Chat
                    // console.log(resp);
                    $('#chatModalClose').text(resp[0].name);
                    $('#receiveID').val(id);
                    $('#videoID').val(vid);
                    $('#videoOwnerID').val(vownerid);
                    $('#messageBody').html(resp[0].msg);
                    $("#eachFriendChatModal").addClass('show').css('display', 'block');

                    // ***Load Message Instant
                    loadMsg(id, vid, vownerid);
                    setInterval(function() {
                        loadMsg(id, vid, vownerid);
                    }, 15000);

                    // Maintain message body function
                    msgBodyMaintain();
                }
            })
        });

        // Message send and appear in the body
        $('body').on('submit', '#msgSendFrm', function(e) {
            e.preventDefault();

            var form = $("#msgSendFrm");

            var receiveID = $('#receiveID').val();
            var videoID = $('#videoID').val();
            var videoOwnerID = $('#videoOwnerID').val();

            $.ajax({
                url: "{{ route('ins_chat_msg') }}",
                type: "POST",
                data: form.serialize(),
                dataType: "json",
                success: function(resp) {
                    // console.log(resp);
                    $("#msgSendFrm")[0].reset()
                    $("#messageBody").append(resp.msg);

                    // Maintain message body function
                    msgBodyMaintain();
                }
            });
        });

        // Load Message Every 5 second
        function loadMsg(receiveID, videoID, videoOwnerID) {
            $.ajax({
                url: "{{ route('load_auth_user_msg') }}",
                type: "GET",
                dataType: "json",
                data: {
                    receiveID: receiveID,
                    videoID: videoID,
                    videoOwnerID: videoOwnerID
                },
                success: function(resp) {
                    // console.log(resp);
                    $('#messageBody').html(resp[0].msg);

                    // Maintain message body function
                    msgBodyMaintain();
                }
            })
        }

        // Unseen msg count function call every 15sec
        setInterval(function() {
            unseenCountFun();
        }, 10000);

        // Unseen msg count function call just one time
        setTimeout(function() {
            unseenCountFun();
        }, 6000);

        // Unseen msg count function
        function unseenCountFun() {
            $(".unseen").each(function(index) {

                var idTag = $(this).attr('id');
                var chatId = idTag.slice(6, 12);

                $.ajax({
                    url: "{{ route('unseen_count') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: chatId,
                    },
                    success: function(resp) {
                        // console.log(resp);
                        $("#unseen" + chatId).text(resp);
                    }
                })
            });
        };

        // Main Message Body
        function msgBodyMaintain() {
            let messageBody = document.querySelector('#messageBody');
            messageBody.scrollTop = messageBody.scrollHeight;
        }

        // ***ALert funtionality for Private Video Share
        $("body").on('click', '.Private', function(e) {

            $("#privateVideoSharemodal").addClass('show').css('display', 'block');
        })

        });
    </script>
@endsection
