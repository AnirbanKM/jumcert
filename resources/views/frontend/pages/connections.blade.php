@extends('layouts.app')

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content connections-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">
                    <div class="row rounded right-connections-section1">

                        <div class="col-xl-4 col-md-6">
                            <div class="each_card ">
                                <img src="{{ asset('frontend/img/each_card/card_1.png') }}" class="w-100" alt="">
                                <div class="top">
                                    <img src="{{ asset('frontend/img/each_card/u1.png') }}" class="user" alt="">
                                    <h3>Courtney Henry
                                        <span>Curaçao</span>
                                    </h3>
                                    <button>
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </div>
                                <div class="down">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-film"></i>1359 Views</a></li>
                                        <li><a href="#"> <i class="fas fa-users"></i> 250 Followers</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
