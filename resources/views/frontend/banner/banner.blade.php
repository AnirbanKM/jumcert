<section class="banner">
    <div class="container">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="{{ asset('frontend/img/banner/banner_1.png') }}" class="w-100" alt="" />
            </div>
            <div class="item">
                <img src="{{ asset('frontend/img/banner/banner_2.png') }}" class="w-100" alt="" />
            </div>
            <div class="item">
                <img src="{{ asset('frontend/img/banner/banner_3.png') }}" class="w-100" alt="" />
            </div>
        </div>
        <div class="slider_content">
            <h6>Jumcert</h6>
            @guest
                <h1>Join #Jumcert Today!!</h1>
                <a href="javascript:void()" id="regBtn" class="common_btn">Register Now</a>
            @endguest

            @auth
                @if (url()->current() == url('videos'))
                    <h1>My Videos</h1>
                    <a href="{{ route('videos') }}" class="common_btn">Upload Vides</a>
                @else
                    <h1>Go for premium plan!!</h1>
                    <a href="{{ route('price_plan') }}" class="common_btn">View Plans</a>
                @endif
            @endauth
        </div>
    </div>
</section>
