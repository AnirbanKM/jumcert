@extends('layouts.app')

<style>
    #addPlaylist .form-check-input {
        height: 15px;
        width: 15px;
        margin-bottom: 0;
    }

</style>

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">
                    <form action="{{ route('channel_create') }}" class="upload_video_frm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row right-homepage-section1">
                            <div class="col-md-12">
                                <div class="heading">
                                    <h2>Create Channel</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="upload-sec">
                                    <div class="inner">
                                        <div class="icon-upload">
                                            <img src="{{ asset('frontend/img/upload.png') }}" alt="">
                                        </div>
                                        <h4>video upload</h4>
                                        <p>Drag & drop your video or select the video file from your computer</p>
                                        <div class="form-group">
                                            <input type="file" name="channel_Image" class="custom-file-input mb-0">
                                            @error('channel_Image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8 after-log-in-sec1-right">
                                <h4>Channel Details</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content of
                                    a page when looking at its layout. </p>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <input type="text" name="name" class="mb-0" placeholder="Title">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @if (auth()->user()->user_role == 2)
                                            <div class="form-group">
                                                <input type="text" name="slug" class="mb-0"
                                                    placeholder="Create Channel Slug">
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif

                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Description" class="mb-0" name="desc"></textarea>
                                            @error('desc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="buttons">
                                            <button class="upload">Create !!!</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Channel Name</th>
                                            <th>Channel Image</th>
                                            <th>Channel Desciption</th>
                                            <th>Edit</th>
                                            <th>Add Playlist</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($channels as $channel)
                                            <tr>
                                                <td>{{ $channel->id }}</td>
                                                <td>{{ $channel->name }}</td>
                                                <td>
                                                    <img src="{{ $channel->image }}" width="100px" alt="" />
                                                </td>
                                                <td>{{ Str::limit($channel->desc, 30) }}</td>
                                                <td>
                                                    <button class="btn btn-primary channelUpd"
                                                        data-cid="{{ $channel->id }}">Edit</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success addPlaylist"
                                                        data-cid="{{ $channel->id }}">
                                                        Add Playlist
                                                    </button>
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

        {{-- Channel Update Modal --}}
        <div class="modal" id="channelModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit your channel</h4>
                        <button type="button" class="channelModalClose">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('channel_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="channeId">
                            <div class="form-group">
                                <input type="text" placeholder="Title" name="cname" class="mb-0" id="cname">
                                @error('cname')
                                    <span class="text-danger d-table">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" name="cimage" class="mb-0" id="cimage">
                                @error('cimage')
                                    <span class="text-danger d-table">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="" alt="" width="100%" id="cPrevImg">
                            </div>
                            <div class="form-group">
                                <textarea name="cdesc" class="form-control mb-0" rows="3" id="cdesc"></textarea>
                                @error('cdesc')
                                    <span class="text-danger d-table">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger channelModalClose">Close</button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Channel Playlist Add Modal --}}
        <div class="modal" id="addPlaylist">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add playlists your channel</h4>
                        <button type="button" class="addPlaylistModalClose">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('channel_playlist_create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="" id="channelId" />

                            @foreach ($playlists as $playlist)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="playlistId" name="playlistId[]"
                                        value="{{ $playlist->id }}" />
                                    <label class="form-check-label" for="playlistId">
                                        {{ $playlist->title }}
                                    </label>
                                </div>
                            @endforeach

                            <div class="col-12 mt-3">
                                <button class="btn btn-primary">
                                    Add Playlist
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger addPlaylistModalClose">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @include('frontend.inc.startsec')
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

            $('body').on('click', '.channelUpd', function() {

                var id = $(this).data('cid');

                $.ajax({
                    url: "{{ route('channel_edit') }}",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp);
                        $("#channeId").val(resp.id);
                        $("#cname").val(resp.name);
                        $("#cdesc").val(resp.desc);
                        $('#cPrevImg').attr('src', resp.image);
                        $('#channelModal').show();
                    }
                })
            })

            $('body').on('click', '.addPlaylist', function(e) {
                e.preventDefault();

                var id = $(this).data('cid');
                $("#channelId").val(id);

                // Add Playlist Modal Show
                $("#addPlaylist").show();
            });

            // Channel Modal Close
            $('.channelModalClose').click(function() {
                $('#channelModal').hide();
            });

            // Add Playlist Modal Close
            $('.addPlaylistModalClose').click(function() {
                $('#addPlaylist').hide();
            });

        });
    </script>
@endsection
