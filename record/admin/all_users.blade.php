@foreach ($users as $user)
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="thumbnail">
                @if ($user->userprofile == null)
                    <img class="card-img-top" src="{{ asset('user.png') }}" alt="Card image cap">
                @else
                    <img class="card-img-top" src="{{ $user->userprofile->image }}" alt="Card image cap">
                @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    @if ($user->userprofile == null)
                        <img src="{{ asset('user.png') }}" class="user_img" alt="" />
                    @else
                        <img src="{{ $user->userprofile->image }}" class="user_img" alt="" />
                    @endif
                    {{ $user->name }}
                    <span> {{ $user->created_at->diffForHumans() }}</span>
                </h5>
                <a href="{{ route('admin.user_info', $user->id) }}" target="_blank" class="btn btn-primary">
                    View user info
                </a>
            </div>
        </div>
    </div>
@endforeach
