@extends('layouts.app')

<style>
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

    a.dislikevideo {
        color: #1c1c1c !important;
    }
</style>

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content stream-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="row homepage-section1">

                        @foreach ($videos as $video)
                            <div class="col-xl-4 col-md-6">

                                {{-- prive video --}}
                                <div class="each_card premium">
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
                                                {{-- If Video User_id == Created User ID --}}
                                                <a href="{{ route('watch_video', $video->video_id) }}" target="_blank">
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
                                            {{-- video Like --}}
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
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')

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

    @auth
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
                $('#publicVideoSharemodal').removeClass('show').css('display', 'none');
                $('#privateVideoSharemodal').removeClass('show').css('display', 'none');
            });

            $('body').on('click', '.eachReqModal', function(e) {

                var vid = $(this).data('vid');
                $('#vid').val(vid);
                $("#chatModal").addClass('show').css('display', 'block');
            });

            @auth
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

            // ***ALert funtionality for Private Video Share
            $("body").on('click', '.Private', function(e) {

                $("#privateVideoSharemodal").addClass('show').css('display', 'block');
            })
        @endauth

        });
    </script>
@endsection
