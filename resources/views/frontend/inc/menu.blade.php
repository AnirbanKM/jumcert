<header>
    <div class="container py-2">
        <div class="row align-items-center justify-content-between">

            <div class="col-md-4 left align-items-center">
                <a href="{{ route('home') }}" class="nav_link">
                    <img src="{{ asset('frontend/img/logo.png') }}" class="logo" alt="">
                </a>
                <form action="{{ route('search_channel') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Search Channel">
                    <input type="submit" value="">
                </form>
            </div>

            <div class="col-md-8 row align-items-center justify-content-between">
                <div id="navigation">
                    <nav>
                        <ul class="menu_sec">
                            <li class="{{ request()->is('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('frontend/img/icon/home.svg') }}" alt="">
                                    Home
                                </a>
                            </li>
                            <li class="{{ request()->is('stream') ? 'active' : '' }}">
                                <a href="{{ route('stream') }}">
                                    <img src="{{ asset('frontend/img/icon/stream.svg') }}" alt="">
                                    Stream
                                </a>
                            </li>
                            <li class="{{ request()->is('subscriptions') ? 'active' : '' }}">
                                @auth
                                    <a href="{{ route('subscriptions') }}">
                                        <img src="{{ asset('frontend/img/icon/event.svg') }}" alt="">
                                        Subsciption
                                    </a>
                                @endauth
                                @guest
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('frontend/img/icon/event.svg') }}" alt="">
                                        Subsciption
                                    </a>
                                @endguest
                            </li>
                        </ul>
                    </nav>
                </div>

                <ul class="log_sec">
                    @guest
                        <li>
                            <a href="" data-toggle="modal" data-target="#smallModal">
                                <img src="{{ asset('frontend/img/nav/login.png') }}" alt="">
                                Login
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li>
                            <a href="{{ route('personal_info') }}">
                                <img src="{{ asset('user.png') }}" id="miniProfileImg" alt="">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="d-none">
                            <a href="javascript:;">
                                <img src="{{ asset('frontend/img/nav/telegram.png') }}" alt="">
                            </a>
                        </li>
                        <li class="d-none">
                            <a href="javascript:;">
                                <img src="{{ asset('frontend/img/nav/noti.png') }}" alt="">
                            </a>
                        </li>
                        <li class="dropdown-sec">
                            <a href="javascript:;">
                                <img src="{{ asset('frontend/img/nav/more.png') }}" alt="">
                            </a>
                            <ul class="drop-profile">
                                <i class="fas fa-times cross-here"></i>
                                <h4>Profile & Settings</h4>

                                <div class="profile">
                                    <div class="image">
                                        <img src="{{ asset('user.png') }}" id="profileImg" alt="">
                                    </div>
                                    <div class="text">
                                        <h6> {{ Auth::user()->name }} </h6>
                                        <a href="{{ route('personal_info') }}">edit profile</a>
                                    </div>
                                </div>

                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/img/sidebar/subscription.png') }}" alt="">
                                    </div>
                                    <a href="{{ route('my_gallery') }}">My Gallery</a>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/img/sidebar/subscription.png') }}" alt="">
                                    </div>
                                    <a href="{{ route('fetch_stream_videos') }}">Streamed Video</a>
                                </li>


                                {{-- Pro or Business Access --}}
                                @if (auth()->user()->user_role == 1 || auth()->user()->user_role == 2)
                                    {{-- For only pro & business users account --}}
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/sidebar/connections.png') }}"
                                                alt="">
                                        </div>
                                        <a href="{{ route('user_account') }}">My Account</a>
                                    </li>
                                    {{-- <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/sidebar/connections.png') }}"
                                                alt="">
                                        </div>
                                        <a href="{{ route('user_wallet') }}">My Wallet</a>
                                    </li> --}}
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/explore.png') }}" alt="">
                                        </div>
                                        <a href="{{ route('channel') }}">Create Channel</a>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/icon/3.png') }}" alt="">
                                        </div>
                                        <a href="{{ route('playlist') }}">Create Playlist</a>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/drop-2.png') }}" alt="">
                                        </div>
                                        <a href="{{ route('video_upload') }}">Upload Video</a>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/drop-4.png') }}" alt="">
                                        </div>
                                        <a href="{{ route('video_edit_frm') }}">Manage Videos</a>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/drop-1.png') }}" alt="">
                                        </div>
                                        <a href="{{ route('videos') }}">My Videos</a>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('frontend/img/drop-5.png') }}" alt="">
                                        </div>
                                        <a href="{{ route('view_chat_requests') }}">Chat Request</a>
                                    </li>
                                @endif

                                {{-- Other Route --}}
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/img/drop-3.png') }}" alt="">
                                    </div>
                                    <a href="#">Help and Support</a>
                                </li>

                                {{-- Logout --}}
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('frontend/img/drop-6.png') }}" alt="">
                                    </div>
                                    <a href="{{ route('logout') }}">Logout</a>
                                </li>

                                <p>Copyright 2022 Jumcert</p>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>

<style>
    #profileImg {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>

<link rel="stylesheet" href="{{ asset('noty/noty.min.css') }}">
<script src="{{ asset('noty/noty.js') }}"></script>
