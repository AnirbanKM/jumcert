@extends('layouts.app')

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">
                    <div class="row right">
                        <div class="col-lg-7">
                            <h2>Professional And Dedicated Service from decades</h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a
                                page when looking at its layout. The point of using Lorem Ipsum is that it has a
                                more-or-less normal distribution of letters, as opposed to using 'Content here, content
                                here', making it look like readable English. </p>
                            <br>
                            <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default
                                model text, and a search for 'lorem ipsum' will uncover many web sites still in their
                                infancy. Various versions have evolved over the years, sometimes by accident, sometimes on
                                purpose (injected humour and the like).</p>
                            <img class="signature" src="{{ asset('frontend/img/sign.png') }}" alt="">
                            <p>Robert William, CEO</p>
                        </div>
                        <div class="col-lg-5">
                            <img class="right-image" src="{{ asset('frontend/img/about-sec1.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
