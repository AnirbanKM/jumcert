@extends('layouts.app')

@section('content')
    <style>
        table tr td {
            white-space: nowrap;
        }

        button.notcancel {
            background: #c9adad !important;
        }

        button.streamCompleted {
            background: green !important;
            pointer-events: none;
        }

        form.upload_video_frm .custom-file-input::before {
            content: 'Select stream thumbnail';
        }

        #datetimeP {
            margin: 0;
            text-align: left
        }

        #streaming_datetime {
            margin-top: 5px;
            color: green;
            font-weight: 500;
        }
    </style>

    @include('frontend.banner.banner')

    <section class="page_content connections-section1 videos-section1 channel-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">
                    <div class="row rounded right-connections-section1 right-videos-section1 right-channel-section1">

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
                                <li>
                                    <a class="nav-link" id="live-tab" data-toggle="tab" href="#live" role="tab"
                                        aria-controls="live" aria-selected="false">Upcoming
                                        Live</a>
                                </li>
                                <li>
                                    <a class="nav-link " id="live-tab" data-toggle="tab" href="#livehistory" role="tab"
                                        aria-controls="live" aria-selected="true">Live History</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">

                            {{-- Live Stream Videos --}}
                            <div class="tab-pane fade show active" id="videos" role="tabpanel" aria-labelledby="videos">
                                <div class="row">
                                    @foreach ($videos as $video)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="each_card" style="overflow: hidden;">
                                                <img src=" {{ $video->thumbnail }}" class="w-100" alt="">
                                                <div class="top">
                                                    <h3>{{ $video->title }}
                                                        <span>{{ $video->category->name }} |
                                                            {{ $video->created_at->diffForHumans() }}
                                                        </span>
                                                    </h3>
                                                </div>
                                                <div class="down">
                                                    <ul class="d-none">
                                                        <li class="like"><a href="#"><i
                                                                    class="fas fa-thumbs-up"></i>0 Likes</a></li>
                                                        <li><a href="#"><i class="fas fa-eye"></i> 0 Views</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {!! $videos->links() !!}
                            </div>

                            {{-- Live Stream Playlist's --}}
                            <div class="tab-pane fade" id="playlist" role="tabpanel" aria-labelledby="playlist">
                                <div class="row">
                                    @foreach ($playlists as $playlist)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="each_card ">
                                                <img src="{{ str_replace('public', 'storage', $playlist->image) }}"
                                                    class="w-100" alt="">
                                                <div class="top playlist-top">
                                                    <h3> {{ $playlist->title }}
                                                        <span>
                                                            @if ($playlist->videos()->count() > 10)
                                                                10 +
                                                            @else
                                                                {{ $playlist->videos()->count() }}
                                                            @endif
                                                        </span>
                                                    </h3>

                                                    <a href="{{ route('playlist_videos', $playlist->id) }}"
                                                        class="view-playlist">
                                                        View Full Playlist
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Live Stream channel --}}
                            <div class="tab-pane fade" id="channel" role="tabpanel" aria-labelledby="channel">
                                <div class="row">
                                    @foreach ($channels as $channel)
                                        <div class="col-xl-4 col-md-6 channel-card">
                                            <div class="each_card">
                                                <img class="channel-img"
                                                    src="{{ str_replace('public', 'storage', $channel->image) }}"
                                                    class="w-100" alt="">
                                                <div class="top channel-top">

                                                    @if ($channel->user_info == null)
                                                        <img src="{{ asset('user.png') }}" class="user"
                                                            alt="" />
                                                    @else
                                                        <img src="{{ str_replace('public', 'storage', $channel->user_info->image) }}"
                                                            class="user" alt="" />
                                                    @endif

                                                    <h3>{{ $channel->name }}</h3>
                                                    <a href="{{ route('frontend_channel', $channel->slug) }}"
                                                        class="sub-now">
                                                        View Channel
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if (session()->has('streamErr'))
                                <script>
                                    var videosTab = document.getElementById("videos-tab");
                                    videosTab.classList.remove("active");

                                    var liveTab = document.getElementById("live-tab");
                                    liveTab.classList.add("active");

                                    var videos = document.getElementById("videos");
                                    videos.classList.remove("show", "active");
                                </script>
                            @endif

                            {{-- Live Stream Create --}}
                            <div class="tab-pane fade {{ Session::get('streamErr') }}" id="live" role="tabpanel"
                                aria-labelledby="live">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="upload_video_frm live-video-frm">
                                            <div class="row right-homepage-section1">
                                                <div class="col-md-12">

                                                    <div class="heading">
                                                        <h2>Upcoming Live</h2>
                                                        <a href="#" data-toggle="modal" data-target="#live-modal">
                                                            <div class="upload-sec">
                                                                <div class="inner">
                                                                    <div class="icon-upload">
                                                                        <i class="fas fa-video"></i>
                                                                    </div>
                                                                    Shedule a live
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    @if (session()->has('error'))
                                                        <span class="badge badge-danger" style="margin: 10px;">
                                                            {{ Session::get('error') }}
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Streaming Time</th>
                                                            <th scope="col">Topic</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Playlist</th>
                                                            <th scope="col">Channel</th>
                                                            <th scope="col">Action</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Go Live</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($liveStreams as $item)
                                                            <tr>
                                                                <td scope="row">{{ $loop->index + 1 }}</td>
                                                                <td>{{ $item->streamDateTime }} </td>
                                                                <td>{{ $item->topic }}</td>
                                                                <td>{{ $item->stream_type }} </td>
                                                                <td>{{ $item->playListInfo->title }}</td>
                                                                <td>{{ $item->channel->name }}</td>

                                                                {{-- Go Live Edit --}}
                                                                <td>
                                                                    @if (strtotime($item->streamDateTime) > strtotime('now'))
                                                                        <button type="button" class="streamEdit"
                                                                            data-id={{ base64_encode($item->id) }}>
                                                                            Edit
                                                                        </button>
                                                                    @else
                                                                        <button class="streamCompleted">Edit</button>
                                                                    @endif
                                                                </td>

                                                                {{-- Go Live Pending/Cancelled/Streaming/Cancelled --}}
                                                                <td>
                                                                    @if ($item->status == 'Pending')
                                                                        <button id="liveCancelStatus" class="notcancel"
                                                                            data-sid={{ $item->id }}
                                                                            data-status="Cancelled">
                                                                            Cancel
                                                                        </button>
                                                                    @elseif($item->status == 'Cancelled')
                                                                        <button id="liveCancelStatus" class="inactive"
                                                                            data-sid={{ $item->id }}
                                                                            data-status="Pending">
                                                                            Cancelled
                                                                        </button>
                                                                    @else
                                                                        <button class="streamCompleted">
                                                                            {{ $item->status }}
                                                                        </button>
                                                                    @endif
                                                                </td>

                                                                {{-- Go Live button --}}
                                                                <td>
                                                                    @if (strtotime($item->streamDateTime) > strtotime('now'))
                                                                        <form
                                                                            action="{{ route('join_as_host', $item->channel->slug) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $item->id }}"
                                                                                name="streamId" />
                                                                            <input type="submit" value="Go Live"
                                                                                class="btn btn-primary" />
                                                                        </form>
                                                                    @else
                                                                        <button class="streamCompleted">
                                                                            Go Live
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Live Stream History --}}
                            <div class="tab-pane fade" id="livehistory" role="tabpanel" aria-labelledby="live">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div action="#" class="upload_video_frm live-video-frm">
                                            <div class="row right-homepage-section1">
                                                <div class="col-md-12">
                                                    <div class="heading">
                                                        <h2>Live History</h2>
                                                        <div class="upload-sec">
                                                            <i class="fas fa-history"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">stream Date Time</th>
                                                            <th scope="col">Topic</th>
                                                            <th scope="col">Stream Type</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($liveStreams as $item)
                                                            <tr>
                                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                                <td>{{ $item->streamDateTime }}</td>
                                                                <td>{{ $item->topic }}</td>
                                                                <td>{{ $item->stream_type }}</td>
                                                                <td>
                                                                    @if (strtotime($item->streamDateTime) > strtotime('now') && $item->status != 'Cancelled')
                                                                        <span class="badge badge-success">
                                                                            Upcoming
                                                                        </span>
                                                                    @elseif($item->status == 'Cancelled')
                                                                        <span class="badge badge-danger">
                                                                            {{ $item->status }}
                                                                        </span>
                                                                    @else
                                                                        <span class="badge badge-warning">
                                                                            {{ $item->status }}
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
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

    @include('frontend.inc.startsec')
@endsection

@section('GoLiveModal')
    {{-- live stream create --}}
    <div class="modal fade" id="live-modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Go Live</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('live_stream_create') }}" method="POST" class="upload_video_frm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row right-homepage-section1">
                            <div class="col-md-12 after-log-in-sec1-right">
                                <div class="row">
                                    <div class="col-md-12">

                                        {{-- stream date time --}}
                                        <div class="form-group">
                                            <input type="datetime-local" class="mb-0" name="streamDateTime"
                                                placeholder="Streaming Date">
                                            @error('streamDateTime')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- stream topic --}}
                                        <div class="form-group">
                                            <input type="text" class="mb-0" name="streaming_topic"
                                                placeholder="Streaming Topic">
                                            @error('streaming_topic')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- stream playlist --}}
                                        <div class="form-group">
                                            <select class="form-control" name="streaming_playlist">
                                                @foreach ($playlists as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->title }} </option>
                                                @endforeach
                                            </select>
                                            @error('streaming_playlist')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- stream channel --}}
                                        <div class="form-group">
                                            <select class="form-control" name="streaming_channel">
                                                @foreach ($channels as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('streaming_channel')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- stream type Public/Private --}}
                                        <div class="form-group">
                                            <select class="form-control mb-0" name="stream_type" id="stream_type">
                                                <option value="Public">Public</option>
                                                <option value="Private">Private</option>
                                            </select>
                                            @error('stream_type')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- stream price --}}
                                        <div class="form-group">
                                            <input type="text" class="mb-0" name="price" placeholder="price"
                                                id="price" />
                                            @error('streamDateTime')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- stream thumbnail --}}
                                        <div class="form-group">
                                            <input type="file" class="custom-file-input" name="thumbnail" />
                                            @error('thumbnail')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- stream Description --}}
                                        <div class="form-group">
                                            <textarea placeholder="Description" class="mb-0" name="streaming_description" placeholder="Streaming Description"></textarea>
                                            @error('streaming_description')
                                                <span class="text-danger d-block text-left">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="buttons">
                                            <button class="upload">Go Live</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- live stream edit --}}
    <div class="modal fade show" id="edit_live_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
        aria-modal="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Live</h4>
                    <button type="button" class="close streamClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('stream_update') }}" class="upload_video_frm" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="streamID">
                        <div class="row">
                            <div class="col-md-12">

                                {{-- stream Date Time --}}
                                <div class="form-group">
                                    <input type="datetime-local" class="mb-0 datepicker-here" name="streamDateTime"
                                        placeholder="Streaming Date" />
                                    <p id="datetimeP">Stream Datetime: <span id="streaming_datetime"></span></p>
                                    @error('streamDateTime')
                                        <span class="text-danger d-block text-left">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- stream Topic --}}
                                <div class="form-group">
                                    <input type="text" class="mb-0" name="streaming_topic" id="streaming_topic"
                                        placeholder="Streaming Topic" />
                                    @error('streaming_topic')
                                        <span class="text-danger d-block text-left">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- stream Playlist --}}
                                <div class="form-group">
                                    <select class="form-control" name="streaming_playlist" id="streaming_playlist">
                                    </select>
                                    @error('streaming_playlist')
                                        <span class="text-danger d-block text-left">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- stream Channel --}}
                                <div class="form-group">
                                    <select class="form-control" name="streaming_channel" id="streaming_channel">
                                    </select>
                                    @error('streaming_channel')
                                        <span class="text-danger d-block text-left">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- stream description --}}
                                <div class="form-group">
                                    <textarea placeholder="Description" class="mb-0" name="streaming_description" id="streaming_description"
                                        placeholder="Streaming Description"></textarea>
                                    @error('streaming_description')
                                        <span class="text-danger d-block text-left">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="buttons">
                                    <button class="upload">Update</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('frontendJs')
    <script>
        // ***Stream info update
        $('body').on('click', '.streamEdit', function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");

            $.ajax({
                url: "{{ route('stream_edit') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(resp) {
                    console.log(resp.streamDateTime);
                    $("#streamID").val(resp.id);
                    $("#streaming_datetime").text(resp.streamDateTime);
                    $("#streaming_topic").val(resp.topic);
                    $("#streaming_description").val(resp.desc);
                    $("#streaming_playlist").html(resp.playlist);
                    $("#streaming_channel").html(resp.channel);
                    // set data & popup modal
                    $("#edit_live_modal").show();
                }
            })
        });

        // ***Stream Status Pending || Cancel
        $('body').on('click', '#liveCancelStatus', function(event) {
            event.preventDefault();

            var id = $(this).attr("data-sid");
            var status = $(this).attr("data-status");

            $.ajax({
                url: "{{ route('stream_status') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id,
                    status: status
                },
                success: function(resp) {
                    console.log(resp);
                    if (resp.status == "success") {
                        location.reload();
                    } else {
                        console.log("error");
                    }
                }
            })
        });

        // Stream Modeal close
        $('.streamClose').click(function() {
            $('#edit_live_modal').hide();
        });

        // Public | Private Dependency select with price
        $('#price').fadeOut();
        $('#stream_type').on('change', function() {
            var vType = this.value;

            if (vType == 'Public') {
                $('#price').fadeOut();
            } else {
                $('#price').fadeIn();
            }
        });
    </script>
@endsection
