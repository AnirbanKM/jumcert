0 - Free
1 - Pro
2 - Busniess

Pa$$w0rd!

@foreach ($categories as $category)
    <tr>
        <td> {{ $category->name }} </td>
        <td> {{ $category->desc }} </td>
        <td>
            <a href="javascript:;" class="btn btn-info" id="updatecategory" data-eid="{{ $category->id }}">
                Edit
            </a>
        </td>
        <td>
            <button class="btn btn-danger" id="delcategory" data-id="{{ $category->id }}">
                Delete
            </button>
        </td>
    </tr>
@endforeach


@php
if ($r->hasFile('uvideo')) {
    $all_videos = $r->file('uvideo')->store('public/all_videos');
} else {
    $all_videos = '';
}
@endphp

@if ($channels[0]->playlist_id != null)
    @php
        $str = $channels[0]->playlist_id;
        $arr = explode(',', $str);
    @endphp
    @if (in_array($playlist->id, $arr))
        ? checked : "";
    @endif
@endif


@auth
    @if ($video->user_id == Auth::user()->id)
        <a href="{{ route('watch_video', $video->video_id) }}" target="_blank">
            <div class="thumbnail">
                <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king" alt="" />
            </div>
        </a>
    @elseif($video->purchasedVideo->user_id == Auth::user()->id)
        {{-- if user purchased the video --}}
        <a href="{{ route('watch_video', $video->video_id) }}" target="_blank">
            <div class="thumbnail">
                <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king" alt="" />
            </div>
        </a>
        <b>Video is purchased</b>
    @else
        {{-- purchase private video other users --}}
        <div class="card_img" data-id="{{ $video->id }}">
            {{-- video thumbnail --}}
            <div class="thumbnail">
                <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
            </div>
            <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king" alt="" />
        </div>
    @endif
@endauth

@guest
    {{-- purchase private video other users --}}
    <div class="card_img" data-id="{{ $video->id }}">
        {{-- video thumbnail --}}
        <div class="thumbnail">
            <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
        </div>
        <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king" alt="" />
    </div>
@endguest

@auth
    @if ($video->user_id == Auth::user()->id)
        <a href="{{ route('watch_video', $video->video_id) }}" target="_blank">
            <div class="thumbnail">
                <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king" alt="" />
            </div>
        </a>
    @else
        {{-- purchase private video other users --}}
        <div class="card_img" data-id="{{ $video->id }}">
            {{-- video thumbnail --}}
            <div class="thumbnail">
                <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
            </div>
            <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king" alt="" />
        </div>
    @endif
@endauth

<script>
    function streamStatus(streamId, streamStatus) {
        $.ajax({
            url: "{{ route('stream_status_update') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                id: streamId,
                status: streamStatus,
                "_token": "{{ csrf_token() }}",
            },
            success: function(resp) {
                location.reload();
            }
        })
    }
</script>
{{-- Live Stream status update --}}
{{-- Route::post('/stream_status_update', [VideosController::class, 'stream_status_update'])->name('stream_status_update'); --}}


@if (Auth::user()->id == $user->sender_id)
    {{ $user->receiver_id }}."__"
@else
    {{ $user->sender_id }}
@endif


<a href="javascript:void()" data-toggle="modal" data-target="#chatM1">
    <span class="text-uppercase">{{ substr($user->receiverInfo->name, 0, 1) }}</span>
    <h4>{{ $user->receiverInfo->name }}</h4>
</a>
