@extends('layouts.app')

<style>
    .nav-tabs a {
        color: #1c1c1c !important;
    }

    .nav-tabs a.active {
        color: #043df8 !important;
    }

    .videoPlayBtn {
        display: table !important;
        margin: 0 auto !important;
    }
</style>

@section('content')
    <section class="page_content stream-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row right-stream-section1">

                        <div class="col-md-12 right-homepage-section1">
                            <div class="heading">
                                <h2>My purchased videos & streams </h2>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" data-toggle="tab" href="#nav-video">Videos</a>
                                    <a class="nav-item nav-link" data-toggle="tab" href="#nav-stream">Streams</a>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-video">
                                    <div class="py-3">
                                        <div class="row">
                                            @foreach ($videos as $item)
                                                <div class="col-md-4">
                                                    <div class="each_card">
                                                        <div class="thumbnail">
                                                            <img class="card-img-top" src="{{ $item->video->thumbnail }}"
                                                                alt="Card image cap">
                                                        </div>
                                                        <div class="top">
                                                            <h3 class="card-title pl-0">
                                                                {{ $item->video->title }} <br />
                                                                <span> {{ $item->created_at->diffforhumans() }}</span>
                                                            </h3>
                                                            <a href="{{ route('watch_private_video', $item->video->video_id) }}"
                                                                target="_blank" class="btn btn-primary videoPlayBtn">
                                                                View Video
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-stream">
                                    <div class="py-3">
                                        <div class="row stream">

                                            @foreach ($streams as $item)
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="thumbnail">
                                                        <div class="privateStream"
                                                            data-sid="{{ $item->stream->meetingId }}">
                                                            <img src="{{ $item->stream->thumbnail }}" class="w-100"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="top">
                                                        <h3>
                                                            <img src="{{ $item->channel->image }}" alt="" />
                                                            {{ $item->stream->topic }}
                                                            <span>
                                                                {{ $item->created_at->diffForHumans() }}
                                                            </span>
                                                            <span class="badge badge-danger text-white">
                                                                Private
                                                            </span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            @endforeach

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
                    <form action="{{ route('audience_join_stream') }}" method="POST">
                        @csrf
                        <input type="hidden" name="streamId" class="privateStreamId" />
                        <input type="submit" value="Join Stream">
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            $('.privateStream').click(function() {
                var id = $(this).attr("data-sid");
                $('.privateStreamId').val(id);
                $('#privateModal').show();
            });

            $(".modalclose").click(function() {
                $('.modal').hide();
            });
        });
    </script>
@endsection
