@extends('backend.layouts.admin')

<style>
    .card a {
        display: table;
        margin: 0 auto;
    }

    .card h5 {
        position: relative;
        padding-left: 55px;
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
    <h1 class="h3 mb-4 text-gray-800">View all Playlist</h1>

    <div class="row">

        @foreach ($playlists as $playlist)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="thumbnail">
                        <img class="card-img-top" src="{{ $playlist->image }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <img src="{{ $playlist->user_info->image }}" class="user_img" alt="" />
                            {{ $playlist->title }}
                            <span> {{ $playlist->created_at->diffForHumans() }}</span>
                        </h5>
                        <a href="{{ route('admin.playlist_videos', $playlist->id) }}" class="btn btn-primary">
                            View Playlist
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    {!! $playlists->links() !!}
@endsection
