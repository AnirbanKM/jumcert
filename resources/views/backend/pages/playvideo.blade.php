@extends('backend.layouts.admin')

<style>
    video {
        width: 100%;
        margin-bottom: 10px;
    }

</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Play video</h1>

    <video controls>
        <source src="{{ $video->videoname }}" type="video/webm">
        <source src="{{ $video->videoname }}" type="video/mp4">
    </video>

    <h3>Video title : {{ $video->title }}</h3>

    <div class="card-body">
        <table class="table table-bordered">
            <tbody>

                {{-- Video title --}}
                <tr>
                    <th>Video title</th>
                    <td> {{ $video->title }} </td>
                </tr>

                {{-- Video category --}}
                <tr>
                    <th>Video category</th>
                    <td> {{ $video->category->name }} </td>
                </tr>

                {{-- Video sub category --}}
                <tr>
                    <th>Video sub category</th>
                    <td> {{ $video->subcategory }} </td>
                </tr>

                {{-- Video description --}}
                <tr>
                    <th>Video description</th>
                    <td> {{ $video->desc }} </td>
                </tr>

                {{-- Video type --}}
                <tr>
                    <th>Video type</th>
                    <td> {{ $video->video_type }} </td>
                </tr>

                {{-- Video price --}}
                <tr>
                    <th>Video price</th>
                    <td> ${{ $video->price }} </td>
                </tr>

                {{-- Video created by user --}}
                <tr>
                    <th>Video created by user</th>
                    <td> {{ $video->user_primary_info->name }} </td>
                </tr>

                {{-- Video status || updated video status Active/Inactive --}}
                <tr>
                    <th>Video status</th>
                    <td>
                        @if ($video->status == 'Active')
                            <button class="btn btn-success" id="videoStatus" data-id="{{ $video->id }}"
                                data-status="{{ $video->status }}">
                                {{ $video->status }}
                            </button>
                        @else
                            <button class="btn btn-danger" id="videoStatus" data-id="{{ $video->id }}"
                                data-status="{{ $video->status }}">
                                {{ $video->status }}
                            </button>
                        @endif

                    </td>
                </tr>

                {{-- Video thumbnail --}}
                <tr>
                    <th style="width: 200px">Video thumbnail</th>
                    <td><img src="{{ asset($video->thumbnail) }}" alt="" width="300px;"> </td>
                </tr>

                {{-- Video unique id --}}
                <tr>
                    <th style="width: 200px">Video unique id</th>
                    <td>{{ $video->video_id }}</td>
                </tr>

                {{-- Video playlist --}}
                <tr>
                    <th style="width: 200px">Video playlist</th>
                    <td>{{ $video->playlist_info->title }}</td>
                </tr>

                {{-- Video created at --}}
                <tr>
                    <th style="width: 200px">Video created at</th>
                    <td>{{ $video->created_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('adminjs')
    <script>
        jQuery(document).ready(function($) {
            $('#videoStatus').click(function(event) {

                var id = $(this).data('id');
                var status = $(this).data('status');

                $.ajax({
                    url: "{{ route('admin.video_status_update') }}",
                    type: "GET",
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: "json",
                    success: function(resp) {

                        var status = resp.vstatus;

                       if (resp.vstatus=='Active') {
                            $('#videoStatus').removeClass('btn-danger').addClass('btn-success');
                            $('#videoStatus').text(resp.vstatus);
                            $('#videoStatus').attr("data-status",status);
                            console.log($('#videoStatus').data('status'));
                       } else {
                            $('#videoStatus').removeClass('btn-success').addClass('btn-danger');
                            $('#videoStatus').text(resp.vstatus);
                            $('#videoStatus').attr("data-status",status);
                            console.log($('#videoStatus').data('status'));
                       }
                    }
                });
            });
        });
    </script>
@endsection
