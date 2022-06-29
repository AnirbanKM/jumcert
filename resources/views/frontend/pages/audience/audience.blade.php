@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('liveStream') }}/index.css">
    <link rel="stylesheet" href="{{ asset('record') }}/record.css">

    <div class="container-fluid">

        <form id="join-form" name="join-form">
            <div class="button-group">
                <button id="audience-join" type="button" class="btn btn-primary btn-sm">Join as Audience</button>
                <button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Leave</button>
            </div>
        </form>

        <!-- Audience Screen -->
        <div class="row video-group">
            <div class="w-100"></div>
            <div class="col">
                <div id="remote-playerlist" class="player"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('liveStream') }}/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('liveStream') }}/bootstrap.bundle.min.js"></script>
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        var streamId = '{{ $stream->id }}';
        var streamtoken = '{{ $stream->stream_token }}';
        var slug = '{{ $stream->channel->slug }}';

        // ******** Leave click & action ********
        $("button#audience-join").click(function() {
            $("button#leave").addClass("d-block");

            $(".button-group").addClass("leave_btn");

            $(this).addClass("d-none");
        });
    </script>

    <script src="{{ asset('liveStream') }}/basicLive.js"></script>

    <script>
        $("button#audience-join").click(function() {
            setTimeout(function() {
                getResource();
            }, 10000);
        });

        function getResource() {
            var cname = localStorage.getItem("cname");
            var uid = localStorage.getItem("uid");

            $.ajax({
                url: "{{ route('get_resource') }}",
                type: 'GET',
                dataType: "json",
                data: {
                    cname: cname,
                    uid: uid
                },
                success: function(resp) {
                    // console.log(resp);
                    var respId = resp.masterID;
                    recordStartFun(respId, cname, uid);
                }
            });
        }

        function recordStartFun(resourceId, channelSlug, userIdParam) {

            var id = resourceId;
            var appID = "73360382719943c6a12d1602e673eb8f";
            var startUrl = "https://api.agora.io/v1/apps/" + appID + "/cloud_recording/resourceid/" + id +
                "/mode/mix/start";
            var authorizationField =
                'Basic NzZmNGJkMDkxN2E2NDVmMWFhMzA4ODQ3YjEyZjc0Y2M6MWJmYTgxOGJhYjkwNGZjNjg0NjcwNjk5NzY3ZmRkMjg=';

            var bodyObj = {
                "cname": channelSlug.toString(),
                "uid": userIdParam.toString(),
                "clientRequest": {
                    "recordingConfig": {
                        "streamTypes": 2,

                        "channelType": 1,
                        "videoStreamType": 0,
                    },
                    "recordingFileConfig": {
                        "avFileType": [
                            "hls",
                            "mp4"
                        ]
                    },
                    "recordingConfig": {
                        "transcodingConfig": {
                            "height": 500,
                            "width": 1200,
                            "bitrate": 500,
                            "fps": 15,
                            "mixedVideoLayout": 1,
                            "backgroundColor": "#FF0000"
                        }
                    },
                    "storageConfig": {
                        "vendor": 1,
                        "region": 0,
                        "bucket": "jumcertstorage",
                        "accessKey": "AKIA3IE3MMFQ37HUMCBV",
                        "secretKey": "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",
                        "fileNamePrefix": ["jumcert"]
                    }
                }
            }

            $.ajax({
                url: startUrl,
                type: 'POST',
                dataType: 'json',
                async: true,
                headers: {
                    "Authorization": authorizationField
                },
                contentType: 'application/json',
                data: JSON.stringify(bodyObj),
                success: function(response) {
                    console.log('success for getting start the record');
                    console.log(response);

                    localStorage.setItem("cname", channelSlug);
                    localStorage.setItem("uid", userIdParam);

                    localStorage.setItem("yourappid", appID);
                    localStorage.setItem("resourceid", response.resourceId);
                    localStorage.setItem("sid", response.sid);
                },
                error: function(error) {
                    console.log('error for getting start the record');
                    console.log(error);
                }
            });
        };

        $("#leave").click(function() {
            alert("stopRecordingFun");
        });

        // Stop record function
        function stopRecordingFun() {

            var cname = localStorage.getItem("cname");
            var uid = localStorage.getItem("uid");
            var appid = localStorage.getItem("yourappid");
            var resourceid = localStorage.getItem("resourceid");
            var sid = localStorage.getItem("sid");

            var stopUrl = "https://api.agora.io/v1/apps/" + appid + "/cloud_recording/resourceid/" + resourceid + "/sid/" +
                sid + "/mode/mix/stop";

            var authorizationField =
                'Basic NzZmNGJkMDkxN2E2NDVmMWFhMzA4ODQ3YjEyZjc0Y2M6MWJmYTgxOGJhYjkwNGZjNjg0NjcwNjk5NzY3ZmRkMjg=';

            var bodyObj = {
                "cname": cname.toString(),
                "uid": uid.toString(),
                "clientRequest": {}
            };

            $.ajax({
                url: stopUrl,
                type: 'POST',
                dataType: 'json',
                headers: {
                    "Authorization": authorizationField
                },
                contentType: 'application/json',
                data: JSON.stringify(bodyObj),
                success: function(resp) {
                    // console.log(resp);
                    console.log('success on stop recording');
                    var streamlink = resp.serverResponse.fileList[0].fileName;
                    createStreamRecord(streamlink);
                },
                error: function(error) {
                    console.log('problem on stop recording');
                    console.log(error);
                }
            });

            function createStreamRecord(streamlinkParam) {

                $.ajax({
                    url: '{{ route('stream_record_ins') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        streamId: streamId,
                        streamlink: streamlinkParam
                    },
                    success: function(resp) {
                        console.log("success on create record on db");
                        console.log(resp);
                        if (resp.status == 200) {
                            setTimeout(function() {
                                window.location = "{{ route('fetch_stream_videos') }}";
                            }, 3000);
                        }
                    },
                    error: function(error) {
                        console.log('problem on insert record on db');
                        console.log(error);
                    }
                });
            }
        }
    </script>
@endsection
