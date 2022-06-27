@if ($video->video_type == 'Public')
    <div class="col-xl-4 col-md-6">
        <div class="each_card">
            <div class="top">
                <h3>
                    <img src="{{ $video->user_info->image }}" class="user" alt="" />
                    {{ $video->title }}
                    <span>{{ $video->created_at->format('M d, Y') }}</span>
                </h3>
                <button>
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>

            <a href="{{ route('watch_video', $video->video_id) }}" target="_blank">
                <div class="thumbnail">
                    <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                </div>
            </a>

            <div class="down">
                <ul>
                    <li><a href="#"><i class="fas fa-thumbs-up"></i> 0 Like</a></li>
                    <li><a href="#"><i class="fas fa-share-alt"></i> Share</a></li>
                </ul>
            </div>
        </div>
    </div>
@else
    <div class="col-xl-4 col-md-6">

        {{-- prive video --}}
        <div class="each_card premium">
            <div class="top">
                <h3>
                    <img src="{{ $video->user_info->image }}" class="user" alt="" />
                    {{ $video->title }}
                    <span>{{ $video->created_at->format('M d, Y') }}</span>
                </h3>
                <button>
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>

            @auth
                @if ($video->user_id == Auth::user()->id)
                    <a href="{{ route('watch_video', $video->video_id) }}" target="_blank">
                        <div class="thumbnail">
                            <img src="{{ $video->thumbnail }}" class="w-100 m-0" alt="" />
                            <img src=" {{ asset('frontend/img/each_card/king.png') }}" class="king" alt="" />
                        </div>
                    </a>
                @elseif($video->purchasedVideo)
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

            <div class="down">
                <ul>
                    <li><a href="#"><i class="fas fa-thumbs-up"></i> 0 Like</a></li>
                    <li><a href="#"><i class="fas fa-share-alt"></i> Share</a></li>
                </ul>
            </div>
        </div>

    </div>
@endif

<div class="user-incoming">
    <a href="javascript:void()" class="d-none">
        <span>A</span>
        <h4>Alex Simpson</h4>
    </a>
    <p>Hey how are you !!</p>
</div>
<div class="user-outgoing">
    <p>ohh i am good , how about you</p>
</div>

{{-- Incoming Msg --}}
<div class="user-incoming">
    <a href="javascript:void()" class="d-none">
        <span>A</span>
        <h4>Alex Simpson</h4>
    </a>
    <p>Hey how are you !!</p>
</div>
{{-- Sending Msg --}}
<div class="user-outgoing">
    <a href="javascript:void()" class="d-none">
        <span>B</span>
        <h4>Bob wellings</h4>
    </a>
    <p>ohh i am good , how about you</p>
</div>


@foreach ($friends as $user)
    @if (Auth::user()->id == $user->sender_id)
        <a href="javascript:void()" class="chatM receive" data-rid={{ $user->receiver_id }}
            data-sid={{ $user->sender_id }} data-vid={{ $user->video_id }} data-vownerid={{ $user->owner_id }}>
            <span class="text-uppercase">{{ substr($user->receiverInfo->name, 0, 1) }}</span>
            <h4>{{ $user->receiverInfo->name }}</h4>
            <h6 class="unseen" id="unseen{{ $user->id }}"> 0 </h6>
        </a>
    @else
        <a href="javascript:void()" class="chatM send" data-rid={{ $user->sender_id }}
            data-sid={{ $user->sender_id }} data-vid={{ $user->video_id }} data-vownerid={{ $user->owner_id }}>
            <span class="text-uppercase">{{ substr($user->userinfo->name, 0, 1) }}</span>
            <h4>{{ $user->userinfo->name }}</h4>
            <h6 class="unseen" id="unseen{{ $user->id }}"> 0 </h6>
        </a>
    @endif
@endforeach
