@extends('layouts.app')

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content support-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="row right-support-section1">

                        <div class="col-lg-4">
                            <div class="each_plan">
                                <div class="card-head">
                                    <div class="image">
                                        <img src="{{ asset('frontend/img/icon/10.png') }}" alt="">
                                    </div>
                                    <h6>24x7 Customer Support</h6>
                                </div>
                                <p>Questions? Comments? We’d love to hear from you.
                                    Please don’t hesitate to get in touch Call Us:</p>
                                <a href="#"> +1-(415)-418-7755</a>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="each_plan">
                                <div class="card-head">
                                    <div class="image">
                                        <img src="{{ asset('frontend/img/icon/10.png') }}" alt="">
                                    </div>
                                    <h6>Technical Support</h6>
                                </div>
                                <p>Questions? Comments? We’d love to hear from you.
                                    Please don’t hesitate to get in touch Call Us:</p>
                                <a href="#"> +1-(415)-418-7755</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="each_plan">
                                <div class="card-head">
                                    <div class="image">
                                        <img src="{{ asset('frontend/img/icon/10.png') }}" alt="">
                                    </div>
                                    <h6>Help</h6>
                                </div>
                                <p>Questions? Comments? We’d love to hear from you.
                                    Please don’t hesitate to get in touch Call Us:</p>
                                <a href="#"> +1-(415)-418-7755</a>
                            </div>
                        </div>
                    </div>

                    @auth
                        <div class="row right-support-section2">
                            <div class="col-md-6">
                                <img src="{{ asset('frontend/img/sendusmsg.png') }}" alt="">
                            </div>
                            <div class="col-md-6">
                                <h2>Send us message</h2>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                    suffered alteration in some form, by injected humour.
                                </p>

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('store_msg') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Name" name="name" />

                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Email" name="email" />
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Phone" name="phone">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Country" name="country">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea placeholder="Message" name="msg"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" value="SEND" />
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </section>
@endsection
