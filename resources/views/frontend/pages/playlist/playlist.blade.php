@extends('layouts.app')

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row right-homepage-section1">

                        <div class="col-md-12">
                            <div class="heading">
                                <h2>Create Playlist</h2>
                            </div>
                        </div>

                        <div class="col-md-12 after-log-in-sec1-right">
                            <h4>PlayList Details</h4>
                            <p>Add your playlist</p>

                            <div class="row playlist_details">

                                <div class="col-md-4">

                                    <form action="{{ route('playlist_create') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" placeholder="Title" name="title" class="mb-0">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="image" class="mb-0">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <textarea name="desc" class="form-control mb-0" rows="3"></textarea>
                                            @error('desc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="buttons">
                                            <button class="upload">
                                                Create
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Playlist Category</th>
                                                    <th>Image</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($playlists as $playlist)
                                                    <tr>
                                                        <td> {{ $playlist->id }} </td>
                                                        <td> {{ $playlist->title }} </td>
                                                        <td>
                                                            <img src="{{ str_replace('public', 'storage', $playlist->image) }}"
                                                                width="100px">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary playListUpd"
                                                                data-pid="{{ $playlist->id }}">
                                                                Update
                                                            </button>
                                                        </td>
                                                        <td> <button class="btn btn-danger">Delete</button> </td>
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
    </section>


    <!-- The Modal -->
    <div class="modal" id="playListModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit your playlist</h4>
                    <button type="button" class="playListModalClose">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('update_playlist') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="playlistId">
                        <div class="form-group">
                            <input type="text" placeholder="Title" name="utitle" class="mb-0" id="title">
                            @error('utitle')
                                <span class="text-danger d-table">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="file" name="uimage" class="mb-0" id="image">
                            @error('uimage')
                                <span class="text-danger d-table">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <img src="" id="prevPlaylistImg" alt="" class="w-100">
                        </div>
                        <div class="form-group">
                            <textarea name="udesc" class="form-control mb-0" rows="3" id="desc"></textarea>
                            @error('udesc')
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
                    <button type="button" class="btn btn-danger playListModalClose">Close</button>
                </div>

            </div>
        </div>
    </div>
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

            $('body').on('click', '.playListUpd', function() {

                var id = $(this).data('pid');

                $.ajax({
                    url: "{{ route('find_playlist') }}",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp);
                        $("#title").val(resp.title);
                        $("#desc").val(resp.desc);
                        $("#playlistId").val(resp.id);
                        $('#prevPlaylistImg').attr('src', resp.image);
                        $('#playListModal').show();
                    }
                })
            });

            $('.playListModalClose').click(function() {
                $('#playListModal').hide();
            });

        });
    </script>
@endsection
