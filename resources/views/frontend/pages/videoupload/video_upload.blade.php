@extends('layouts.app')

<style>
    span.err {
        text-align: center;
        width: 80%;
        display: table;
        margin: 0 auto;
        font-weight: 500;
        color: rgb(233, 71, 71);
    }

    span.stringErr {
        text-align: left;
        width: 100%;
        display: table;
        margin: 0 auto;
        font-weight: 500;
        color: rgb(233, 71, 71);
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
                    <form class="upload_video_frm" action="{{ route('video_upload_ins') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row right-homepage-section1">
                            <div class="col-md-12">
                                <div class="heading">
                                    <h2>Upload Video</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="upload-sec">
                                    <div class="inner mb-3">
                                        <div class="icon-upload">
                                            <img src="{{ asset('frontend/img/upload.png') }}" alt="">
                                        </div>
                                        <h4>video upload</h4>
                                        <input type="file" class="custom-file-input" name="video" />
                                        @error('video')
                                            <span class="err">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="inner">
                                        <div class="icon-upload">
                                            <img src="{{ asset('frontend/img/upload.png') }}" alt="">
                                        </div>
                                        <h4>video thumbnail upload</h4>
                                        <input type="file" class="custom-file-input" name="thumbnail" />
                                        @error('thumbnail')
                                            <span class="err">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 after-log-in-sec1-right">
                                <h4>Video Details</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content of
                                    a page when
                                    looking at its layout. </p>

                                <div class="row">

                                    {{-- Title --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Title" class="mb-0" name="title">
                                            @error('title')
                                                <span class="stringErr">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Category select Option --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control mb-0" name="category">
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="stringErr">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- subcategory --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Subcategory" class="mb-0"
                                                name="subcategory">
                                            @error('subcategory')
                                                <span class="stringErr">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Playlist select Option --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control mb-0" name="playlist">
                                                @foreach ($playlists as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('playlist')
                                                <span class="stringErr">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- public / private video type --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control mb-0" name="video_type" id="video_type">
                                                <option value="Public">Public</option>
                                                <option value="Private">Private</option>
                                            </select>
                                            @error('video_type')
                                                <span class="stringErr">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- price --}}
                                    <div class="col-md-12" id="price">
                                        <div class="form-group">
                                            <input type="text" placeholder="price" name="price" class="mb-0" />
                                            @error('price')
                                                <span class="stringErr">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- description --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Description" name="desc" class="mb-0"></textarea>
                                            @error('desc')
                                                <span class="stringErr">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="buttons">
                                            <button class="cancel">Cancel</button>
                                            <button class="upload">Upload Video</button>
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
            $('#price').fadeOut();

            $('#video_type').on('change', function() {
                var vType = this.value;

                if (vType == 'Public') {
                    $('#price').fadeOut();

                } else if (vType == 'Private') {
                    $('#price').fadeIn();

                } else {
                    new Noty({
                        theme: 'sunset',
                        type: 'success',
                        layout: 'topRight',
                        text: "Something went wrong",
                        timeout: 3000,
                        closeWith: ['click', 'button']
                    }).show();
                }
            });
        });
    </script>
@endsection
