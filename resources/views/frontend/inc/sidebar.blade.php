<div class="sidebar">

    @foreach ($cats as $category)
        @php
            if (request()->segment(3) == $category->category->name) {
                $x = 'active';
            } else {
                $x = '';
            }
        @endphp

        <a href="{{ route('category_video', ['id' => $category->category->id, 'name' => $category->category->name]) }}"
            class="common_btn @php echo $x; @endphp">
            <img src="{{ route('home') }}/{{ str_replace('public', 'storage', $category->category->icon) }}"
                alt="" />
            {{ $category->category->name }}
        </a>
    @endforeach

    <a href="{{ route('about') }}" class="common_btn {{ request()->is('about') ? 'active' : '' }}">
        <img src="{{ asset('frontend/img/icon/7.png') }}" alt="">
        About Jumcert
    </a>
    <a href="{{ route('how_it_works') }}" class="common_btn {{ request()->is('how_it_works') ? 'active' : '' }}">
        <img src="{{ asset('frontend/img/icon/8.png') }}" alt="">
        How it works
    </a>

    @auth
        <a href="{{ route('personal_info') }}"
            class="common_btn {{ request()->is('personal_info') ? 'active' : '' }}">
            <img src="{{ asset('frontend/img/icon/9.png') }}" alt="" />
            Settings
        </a>

        @if (auth()->user()->user_role == 1 || auth()->user()->user_role == 2)
            <a href="{{ route('video_upload') }}"
                class="common_btn {{ request()->is('video_upload') ? 'active' : '' }}">
                <img src="{{ asset('frontend/img/icon/9.png') }}" alt="" />
                Upload Videos
            </a>
        @endif

        <a href="https://dashboard.stripe.com/login" class="common_btn" target="_blank">
            <img src="{{ asset('frontend/img/icon/9.png') }}" alt="" />
            Create Stipe Account
        </a>
    @endauth

    <a href="{{ route('supports') }}" class="common_btn {{ request()->is('supports') ? 'active' : '' }}">
        <img src="{{ asset('frontend/img/icon/10.png') }}" alt="" />
        Support
    </a>
    <a href="{{ route('help') }}" class="common_btn {{ request()->is('help') ? 'active' : '' }}">
        <img src="{{ asset('frontend/img/icon/11.png') }}" alt="" />
        FAQ
    </a>
</div>
