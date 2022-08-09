@extends('layouts.app')

<style>
    ul {
        margin-bottom: 0px !important;
    }

    .container {
        max-width: 1280px !important;
    }
</style>

@section('content')
    <link rel="stylesheet" href="{{ asset('liveStream') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('liveStream') }}/index.css">

    <div class="container-fluid">
        <form id="join-form" name="join-form">
            <div class="button-group">
                <button id="host-join" type="submit" class="btn btn-primary btn-sm">Join as host</button>
                <button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Leave</button>
            </div>
        </form>
        <!-- Single button -->
        <div class="row video-group">
            <div class="col">
                <p id="local-player-name" class="player-name"></p>
                <div id="local-player" class="player"></div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div id="remote-playerlist"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('liveStream') }}/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('liveStream') }}/bootstrap.bundle.min.js"></script>
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        var streamId = '{{ $streamId }}';
        var slug = '{{ $slug }}';

        // **** Count total no of visitor on a particular stream or in our site ****
        function stream_record_create() {
            $.ajax({
                url: '{{ route('stream_record_create') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    event_id: "{{ $streamId }}"
                },
                success: function(resp) {
                    console.log(resp);
                    console.log("stream viewers updated");
                }
            });
        }

        // ******** Leave click & action ********
        $("button#host-join").click(function() {
            $("button#leave").addClass("d-block");

            $(".button-group").addClass("leave_btn");

            $(this).addClass("d-none");
        });

        @auth
        stream_record_create();
        @endauth
    </script>

    <script src="{{ asset('liveStream') }}/basicLive.js"></script>

    <script>
        function streamTokenUpdate(streamId, streamToken) {
            $.ajax({
                url: "{{ route('stream_token_update') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: streamId,
                    stream_token: streamToken
                },
                success: function(resp) {
                    console.log(resp);
                }
            });
        }

        // ******** Leave click & action ********
        $("#leave").click(function() {
            setTimeout(function() {
                window.location = "{{ route('fetch_stream_videos') }}";
            }, 3000);
        });
    </script>
@endsection
