@extends('layouts.app')

@section('content')
    <section class="success">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <img src="{{ asset('frontend/img/success.png') }}" alt="">
                    <h3>Your payment has been successfully received for the private video</h3>
                    <p>
                        It is a long established fact that a reader will be
                        distracted by the readable content of a
                        page when looking at its layout.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection

@section('frontendJs')
    <script>
        setTimeout(() => {
            window.location.href = "{{ route('my_gallery') }}";
        }, 3000);
    </script>
@endsection
