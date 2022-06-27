@extends('backend.layouts.admin')

<style>
    .card a {
        display: table;
        margin: 0 auto;
    }

    .card h5 {
        position: relative;
    }

    .card h5 img {
        position: absolute;
        left: 0;
        top: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ff8319;
    }

    .card span {
        display: table;
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-weight: 300;
        font-size: 14px;
        line-height: 20px;
        color: #565C65;
        margin: 0;
        margin-top: 5px;
    }

    .thumbnail {
        height: 230px;
    }

    .thumbnail img {
        height: 230px;
        object-fit: cover;
    }

    .pagination {
        justify-content: center;
    }

</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        User name : {{ $user->name }}
    </h1>

    <div class="card-body">
        <table class="table table-bordered">
            <tbody>

                {{-- User Profile Image --}}
                <tr>
                    <th style="width: 200px">User Profile Image</th>
                    <td>
                        @if ($user->userprofile == null)
                            Profile not created
                        @else
                            <img src="{{ asset($user->userprofile->image) }}" alt="" width="300px;" />
                        @endif

                    </td>
                </tr>

                {{-- User name --}}
                <tr>
                    <th>User name</th>
                    <td> {{ $user->name }} </td>
                </tr>

                {{-- User Primary mail --}}
                <tr>
                    <th>User Primary mail</th>
                    <td> {{ $user->email }} </td>
                </tr>

                {{-- User Secondary mail --}}
                <tr>
                    <th>User Secondary mail</th>
                    <td>
                        @if ($user->userprofile == null)
                            Profile not created
                        @else
                            {{ $user->userprofile->secondary_email }}
                        @endif

                    </td>
                </tr>

                {{-- User Role --}}
                <tr>
                    <th>User Role</th>
                    <td>
                        @if ($user->user_role == 0)
                            Free
                        @elseif($user->user_role == 1)
                            Pro
                        @elseif($user->user_role == 2)
                            Business
                        @endif
                    </td>
                </tr>

                {{-- User Birthday --}}
                <tr>
                    <th>User Birthday</th>
                    <td>
                        @if ($user->userprofile == null)
                            Profile not created
                        @else
                            {{ $user->userprofile->birthday }}
                        @endif
                    </td>
                </tr>

                {{-- User Gender --}}
                <tr>
                    <th>User Gender</th>
                    <td>
                        @if ($user->userprofile == null)
                            Profile not created
                        @else
                            {{ $user->userprofile->gender }}
                        @endif
                    </td>
                </tr>

                {{-- User Contact no. --}}
                <tr>
                    <th>User Contact no.</th>
                    <td>
                        @if ($user->userprofile == null)
                            Profile not created
                        @else
                            {{ $user->userprofile->phone }}
                        @endif
                    </td>
                </tr>

                {{-- User address --}}
                <tr>
                    <th>User address</th>
                    <td>
                        @if ($user->userprofile == null)
                            Profile not created
                        @else
                            {{ $user->userprofile->address }}
                        @endif
                    </td>
                </tr>

                {{-- User created at --}}
                <tr>
                    <th style="width: 200px">User created at</th>
                    <td>{{ $user->created_at->format('M d, Y') }} {{ date('h:i A', strtotime($user->created_at)) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-video">Videos</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#nav-playlist">Playlist</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#nav-channel">Channel</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#nav-ulivestream">
                    Live stream
                </a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            {{-- user uploaded videos --}}
            <div class="tab-pane fade show active" id="nav-video">
                <div class="py-3">
                    @if (count($videos) > 0)
                        <div class="row">
                            @foreach ($videos as $video)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="thumbnail">
                                            <img class="card-img-top" src="{{ $video->thumbnail }}"
                                                alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $video->title }}
                                                <span> {{ $video->created_at->diffForHumans() }}</span>
                                            </h5>
                                            <a href="{{ route('admin.play_video', $video->id) }}" target="_blank"
                                                class="btn btn-primary">
                                                View Video
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $videos->links() !!}
                    @else
                        <span class="badge badge-danger">
                            User not uploaded any video
                        </span>
                    @endif

                </div>
            </div>

            {{-- user created playlists --}}
            <div class="tab-pane fade" id="nav-playlist">
                <div class="py-3">
                    @if (count($playlists) > 0)
                        <div class="row">
                            @foreach ($playlists as $playlist)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="thumbnail">
                                            <img class="card-img-top" src="{{ $playlist->image }}"
                                                alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $playlist->title }}
                                                <span class="d-inline ml-2">
                                                    @if ($playlist->frontendVideos()->count() > 10)
                                                        10 +
                                                    @else
                                                        {{ $playlist->frontendVideos()->count() }}
                                                    @endif
                                                    videos
                                                </span>
                                            </h5>
                                            <span> {{ $playlist->created_at->diffForHumans() }}</span>

                                            <a href="{{ route('admin.playlist_videos', $playlist->id) }}" target="_blank"
                                                class="btn btn-primary">
                                                View Playlist
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $playlists->links() !!}
                    @else
                        <span class="badge badge-danger">
                            User not created any playlist
                        </span>
                    @endif
                </div>
            </div>

            {{-- user created channels --}}
            <div class="tab-pane fade" id="nav-channel">
                <div class="py-3">
                    @if (count($channels) > 0)
                        <div class="row">
                            @foreach ($channels as $channel)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="thumbnail">
                                            <img class="card-img-top" src="{{ $channel->image }}" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $channel->name }}
                                                <span> {{ $channel->created_at->diffForHumans() }}</span>
                                            </h5>
                                            <a href="{{ route('frontend_channel', $channel->slug) }}" target="_blank"
                                                class="btn btn-primary">
                                                View Channel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $channels->links() !!}
                    @else
                        <span class="badge badge-danger">
                            User not created any channel
                        </span>
                    @endif
                </div>
            </div>

            {{-- user created live stream --}}
            <div class="tab-pane fade" id="nav-ulivestream">
                @if (count($liveStreams) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Topic</th>
                                    <th scope="col">Playlist</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liveStreams as $item)
                                    <tr>
                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->live_date }}</td>
                                        <td>{{ $item->live_time }}</td>
                                        <td>{{ $item->topic }}</td>
                                        <td>{{ $item->playListInfo->title }}</td>
                                        <td>
                                            short desc ...
                                        </td>
                                        <td>
                                            @if ($item->status == 'Completed')
                                                <span class="badge badge-success">
                                                    {{ $item->status }}
                                                </span>
                                            @elseif($item->status == 'Pending')
                                                <span class="badge badge-warning">
                                                    {{ $item->status }}
                                                </span>
                                            @elseif($item->status == 'Cancelled')
                                                <span class="badge badge-danger">
                                                    {{ $item->status }}
                                                </span>
                                            @else
                                                <span class="badge badge-primary">
                                                    {{ $item->status }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $liveStreams->links() !!}
                    </div>
                @else
                    <div class="py-3">
                        <span class="badge badge-danger">
                            User not created any live stream
                        </span>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
