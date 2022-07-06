@extends('layouts.app')

<style>
    .each_card .thumbnail img {
        height: 193px;
        object-fit: cover;
    }

    span.badge {
        color: #fff !important;
        font-size: smaller !important;
        font-weight: lighter !important;
        line-height: initial !important;
    }

    span.badge {
        display: inline-block !important;
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
                    <div class="row stream right-stream-section1">

                        @foreach ($streams as $stream)
                            <div class="col-xl-4 col-md-6">

                                <div class="each_card">

                                    <div class="thumbnail">

                                        @auth
                                            {{-- Logic for Private Videos --}}
                                            @if ($stream->stream_type == 'Private')
                                                {{-- If the stream Buyer Limit = 0 Then 1:Many buyer --}}
                                                @if ($stream->stream_buyer_limit == 0)
                                                    {{-- Check if auth user once purchased the private stream or not --}}
                                                    @if ($stream->user_purchased_video == null)
                                                        {{-- IF stream user_id & auth user_id is same || The Host Stream --}}
                                                        @if ($stream->user_id == Auth::user()->id)
                                                            <div class="thumbnail publicModals" data-id={{ $stream->id }}>
                                                                @if ($stream->thumbnail == null)
                                                                    <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                                        alt="" />
                                                                @else
                                                                    <img src="{{ $stream->thumbnail }}" class="w-100"
                                                                        alt="" />
                                                                @endif
                                                            </div>

                                                            {{-- stream host modal --}}
                                                            <div class="modal fade show" id="publicModal{{ $stream->id }}"
                                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog ">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                Your are owner of this stream
                                                                            </h4>
                                                                            <button type="button" class="modalclose"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p> Hey!!! Please go to your My Videos section and
                                                                                start
                                                                                your stream as host
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            {{-- If stream user_id & auth user_id is not same --}}
                                                            <div class="privateStream" data-sid="{{ $stream->id }}">
                                                                @if ($stream->thumbnail == null)
                                                                    <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                                        alt="" />
                                                                @else
                                                                    <img src="{{ $stream->thumbnail }}" class="w-100"
                                                                        alt="" />
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @elseif($stream->user_purchased_video->user_id == Auth::user()->id)
                                                        {{-- Check if auth user once purchased the video --}}
                                                        <div class="thumbnail streamPurchasedModals"
                                                            data-id={{ $stream->id }}>
                                                            @if ($stream->thumbnail == null)
                                                                <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                                    alt="" />
                                                            @else
                                                                <img src="{{ $stream->thumbnail }}" class="w-100"
                                                                    alt="" />
                                                            @endif
                                                        </div>
                                                    @else
                                                        {{-- If stream user_id & auth user_id is not same --}}
                                                        <div class="privateStream" data-sid="{{ $stream->id }}">
                                                            @if ($stream->thumbnail == null)
                                                                <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                                    alt="" />
                                                            @else
                                                                <img src="{{ $stream->thumbnail }}" class="w-100"
                                                                    alt="" />
                                                            @endif
                                                        </div>
                                                    @endif
                                                @else
                                                    {{-- else the stream Buyer Limit = 1 Then 1:1 buyer --}}
                                                    <div class="blurProStream">
                                                        @if ($stream->thumbnail == null)
                                                            <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                                alt="" />
                                                        @else
                                                            <img src="{{ $stream->thumbnail }}" class="w-100"
                                                                alt="" />
                                                        @endif
                                                    </div>
                                                @endif
                                            @else
                                                {{-- Public Stream Conditions --}}
                                                {{-- if condition check if Auht user_id & stream user_id are same public stream --}}
                                                @if ($stream->user_id == Auth::user()->id)
                                                    <div class="thumbnail publicModals" data-id={{ $stream->id }}>
                                                        @if ($stream->thumbnail == null)
                                                            <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                                alt="" />
                                                        @else
                                                            <img src="{{ $stream->thumbnail }}" class="w-100"
                                                                alt="" />
                                                        @endif
                                                    </div>

                                                    <div class="modal fade show" id="publicModal{{ $stream->id }}"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Your are owner of this stream
                                                                    </h4>
                                                                    <button type="button" class="modalclose"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p> Hey!!! Please go to your My Videos section and start
                                                                        your stream as host
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- else condition check if Auht user_id & stream user_id are not same public stream --}}
                                                    <div class="thumbnail publicModals" data-id={{ $stream->id }}>
                                                        @if ($stream->thumbnail == null)
                                                            <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                                alt="" />
                                                        @else
                                                            <img src="{{ $stream->thumbnail }}" class="w-100"
                                                                alt="" />
                                                        @endif
                                                    </div>

                                                    <div class="modal fade show" id="publicModal{{ $stream->id }}"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        This is a public video
                                                                    </h4>
                                                                    <button type="button" class="modalclose"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('public_stream') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="streamId"
                                                                            value="{{ $stream->id }}" />
                                                                        <input type="submit" value="Join Stream">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endauth

                                        @guest
                                            <div class="thumbnail publicAlertModal" data-id={{ $stream->id }}>
                                                @if ($stream->thumbnail == null)
                                                    <img src="{{ asset('thumbnail.jpg') }}" class="w-100"
                                                        alt="" />
                                                @else
                                                    <img src="{{ $stream->thumbnail }}" class="w-100" alt="" />
                                                @endif
                                            </div>
                                        @endguest

                                    </div>

                                    {{-- Channel Imgage, Stream Name, Stream Created Time --}}
                                    <div class="top">
                                        <h3>
                                            @if ($stream->streamDateTime >= strtotime('now'))
                                                <img src="{{ $stream->channel->image }}" class="user"
                                                    alt="" />
                                            @else
                                                <img src="{{ $stream->channel->image }}" alt="" />
                                            @endif

                                            {{ $stream->topic }}
                                            <span>{{ $stream->created_at->diffForHumans() }} </span>
                                            @if ($stream->stream_type == 'Public')
                                                <span class="badge badge-success">
                                                    {{ $stream->stream_type }}
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    {{ $stream->stream_type }}
                                                </span>
                                            @endif
                                            <span class="badge badge-primary">
                                                {{ $stream->host_user_plan_info->plan_name }} Stream
                                            </span>
                                        </h3>
                                    </div>

                                    <div class="down">
                                        <ul style="justify-content: center">
                                            <li>
                                                @guest
                                                    <a href="javascript:;" class="card_img">
                                                        <i class="fas fa-share-alt"></i>
                                                        Share
                                                    </a>
                                                @endguest

                                                @auth
                                                    @if ($stream->stream_type === 'Public')
                                                        <a href="javascript:;" class="public" data-id="{{ $stream->id }}">
                                                            <i class="fas fa-share-alt"></i>
                                                            Share
                                                        </a>
                                                    @else
                                                        <a href="javascript:;" class="privateLink">
                                                            <i class="fas fa-share-alt"></i>
                                                            Share
                                                        </a>
                                                    @endif
                                                @endauth
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

    {{-- Private Modal For Purchase Stream --}}
    <div class="modal fade show" id="privateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        This is a Private video
                    </h4>
                    <button type="button" class="modalclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('private_stream') }}" method="POST">
                        @csrf
                        <input type="hidden" name="streamId" class="privateStreamId" />
                        <input type="submit" value="Buy Stream">
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Public Modal For Public Stream --}}
    <div class="modal fade show" id="publicAlertModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        You need to login for access this video
                    </h4>
                    <button type="button" class="modalclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-primary w-100" id="publicLoginJumcert"> Login Jumcert </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Auth user purchased the --}}
    <div class="modal fade show" id="streamPurchasedModals" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        You already purchased the Stream
                    </h4>
                    <button type="button" class="modalclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 style="font-size: 18px; color: #1c1c1c; text-transform: uppercase;">
                        You already purchased the Stream
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- Already user purchased Pro Stream --}}
    <div class="modal fade show" id="proStreamPurchasedModals" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Opps!!!
                    </h4>
                    <button type="button" class="modalclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 style="font-size: 15px; color: #1c1c1c; text-transform: uppercase;">
                        Some one alreay purchase this pro stream
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for private stream sharing alert --}}
    <div class="modal fade" id="privateStreamSharemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        This is a private stream
                    </h4>
                    <button type="button" class="streamModalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center" style="margin: 0px;">
                        This is a Private stream, link share is not available
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

    @include('frontend.inc.startsec')
@endsection

@section('frontendJs')
    <script>
        jQuery(document).ready(function($) {

            $('body').on('click', '.publicModals', function() {
                var id = $(this).attr("data-id");
                $('.streamId').val(id);
                $('#publicModal' + id).show();
            });

            $(".modalclose").click(function() {
                $('.modal').hide();
            });

            $('.privateStream').click(function() {
                var id = $(this).attr("data-sid");
                $('.privateStreamId').val(id);
                $('#privateModal').show();
            });

            $(".publicAlertModal").click(function() {
                $('#publicAlertModal').show();
            });

            $(".card_img").click(function() {
                $('#publicAlertModal').show();
            });

            $("#publicLoginJumcert").click(function() {
                $('#publicAlertModal').hide();
                $('#smallModal').show().addClass('show');
            })

            $('body').on('click', '.streamPurchasedModals', function() {
                $('#streamPurchasedModals').show();
            });

            $('body').on('click', '.blurProStream', function() {
                $('#proStreamPurchasedModals').show();
            });

            $(".streamModalClose").click(function(event) {

                $('#privateStreamSharemodal').removeClass('show').css('display', 'none');
            });

            // ***ALert funtionality for Private stream Share
            $("body").on('click', '.privateModalClose', function() {

                $("#publicVideoSharemodal").removeClass('show').css('display', 'none');
            })

            // ***Generate link for public stream function
            $("body").on('click', '.public', function(e) {

                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('public_stream_link') }}",
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
            })

            // Copy clipboard => Share link
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

            // Private Link Share modal
            $('.privateLink').click(function(event) {

                $("#privateStreamSharemodal").addClass('show').css('display', 'block');
            });

        });
    </script>
@endsection
