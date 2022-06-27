@extends('layouts.app')

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">
                    <form id="upload_video_frm">
                        @csrf

                        <input type="hidden" name="video_id" id="video_id">
                        <input type="hidden" name="id" id="id">

                        <div class="row right-homepage-section1">

                            <div class="col-md-12">
                                <div class="heading">
                                    <h2>Edit Video</h2>
                                </div>
                            </div>

                            <div class="col-md-12 after-log-in-sec1-right">
                                <div class="form-group">
                                    <select class="form-control mb-0" id="allvideos" name="allvideos">
                                        <option value="">--Select your video--</option>
                                        @foreach ($videos as $item)
                                            <option value="{{ $item->video_id }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    <span id="videoErr"></span>
                                </div>

                                <h4>Video Details</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content of
                                    a page when
                                    looking at its layout.
                                </p>

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Title" name="title" id="title">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control m-0" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $item)
                                                    <option class="eachCat" value="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <span id="catErr"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Subcategory" name="subcategory" id="subcategory">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control m-0" name="playlist" id="playlist_id">
                                                <option value="">Select Playlist</option>
                                                @foreach ($playlists as $playlist)
                                                    <option value="{{ $playlist->id }}">{{ $playlist->title }}</option>
                                                @endforeach
                                            </select>
                                            <span id="playlistErr"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" placeholder="price" name="price" id="price">
                                    </div>

                                    <div class="col-md-12">
                                        <textarea placeholder="Description" name="desc" id="desc"></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="buttons">
                                            <button class="cancel">Cancel</button>
                                            {{-- <button type="button" class="upload">Update</button> --}}
                                            <input type="submit" class="upload" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
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

            $('body').on('change', '#allvideos', function(e) {
                e.preventDefault();

                var videoId = $(this).val();

                $.ajax({
                    url: "{{ route('find_video') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        videoId: videoId
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp !== "") {
                            $("#id").val(resp.id);
                            $("#title").val(resp.title);
                            $("#subcategory").val(resp.subcategory);
                            $("#price").val(resp.price);
                            $("#desc").val(resp.desc);
                            $("#video_id").val(resp.video_id);
                            $("#category_id").html(resp.category);
                            $("#playlist_id").html(resp.playlist);

                        } else {
                            notification("Failed to find your video info", "error");
                        }
                    }
                })
            });

            $('body').on('submit', '#upload_video_frm', function(e) {
                e.preventDefault();

                var form = $("#upload_video_frm");

                var video_id = $("#allvideos").val();
                var title = $("#title").val();
                var category = $("#category_id").val();
                var subcategory = $("#subcategory").val();
                var playlist = $("#playlist_id").val();
                var price = $("#price").val();
                var desc = $("#desc").val();

                if (video_id.trim() == "") {

                    $("#videoErr").text('Please select a video')
                        .addClass('text-danger').removeClass('text-success');

                } else {

                    $("#videoErr").text('Video is selected')
                        .addClass('text-success').removeClass('text-danger');

                    if (title.trim() == "" || subcategory.trim() == "" || price.trim() == "" || desc
                        .trim() == "") {

                        notification("Please fill the form for update your video", "error");

                    } else {

                        if (category.trim() == "") {

                            $("#catErr").text("Please select a category")
                                .addClass('text-danger').removeClass('text-success');

                        } else {

                            $("#catErr").text("Category selected")
                                .addClass('text-success').removeClass('text-danger');

                            if (playlist.trim() == "") {

                                $("#playlistErr").text("Please select a playlist")
                                    .addClass('text-danger').removeClass('text-success');

                            } else {

                                $("#playlistErr").text("Playlist selected")
                                    .addClass('text-success').removeClass('text-danger');

                                $.ajax({
                                    url: "{{ route('update_video') }}",
                                    type: 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(resp) {
                                        console.log(resp);
                                        if (resp.errors) {
                                            notification("Something went wrong", "error")
                                        } else {
                                            notification(resp.success, "success")
                                        }
                                    }
                                });

                            }
                        }
                    }
                }
            })

        });
    </script>
@endsection
