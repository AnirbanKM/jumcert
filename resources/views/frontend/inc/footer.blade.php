<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <p class="ft_title">Questions? Call 0850-380-6444</p>
                <p class="ft_desc">
                    It is a long established fact that a reader
                    will be distracted by the readable content of a page
                    when looking at its layout.
                </p>
                <p class="ft_copy_right">Copyright 2022 Jumcert</p>
            </div>
            <div class="col-lg-2 col-md-5 offset-lg-1 offset-md-1">
                <p class="ft_title">Support</p>
                <ul>
                    <li><a href="{{ route('about') }}">About</a></li>
                </ul>
            </div>
            <div class="col-lg col-md-6">
                <p class="ft_title">Other Links</p>
                <ul>
                    <li><a href="{{ route('how_it_works') }}">How it works</a></li>
                </ul>
            </div>
            <div class="col-lg col-md-5 offset-md-1">
                <p class="ft_title">Importent Links</p>
                <ul>
                    <li><a href="{{ route('help') }}">Help</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

@include('frontend.inc.js')
