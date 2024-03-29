@extends('layouts.app')

@section('content')
    <section class="page_content  .stream-player-section1 works-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row right-works-section1">
                        <div class="col-md-6 mr-md-auto">
                            <h2>How It Works</h2>
                            <ul>
                                <li>
                                    <div class="image">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <div class="text">
                                        <h6>Register</h6>
                                        <p>Register by using your email & create your personal password After registering,
                                            log back in with the credentials created</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="image yellow-gradient">
                                        <i class="fas fa-film"></i>
                                    </div>
                                    <div class="text">
                                        <h6>Profile Creation</h6>
                                        <p>Complete your profile account, choose either the free subscription plan or Pro
                                            Paid Subscription</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="image">
                                        <i class="fas fa-compass"></i>
                                    </div>
                                    <div class="text">
                                        <h6>Subscription Plan</h6>
                                        <p>Once you have selected your plan subscription you may set up a stripe account
                                            (This step is only for PRO MEMBERS ONLY) If you register for a Free plan
                                            subscription you will only have access to Jumcert library to purchase content.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <div class="image">
                                        <i class="fas fa-compass"></i>
                                    </div>
                                    <div class="text">
                                        <h6>Create Channel</h6>
                                        <p>Create Channel (PRO MEMBERS ONLY)</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="image">
                                        <i class="fas fa-compass"></i>
                                    </div>
                                    <div class="text">
                                        <h6>Live Videos</h6>
                                        <p>Create Live Videos or Schedule Pre Live Videos (PRO MEMBERS ONLY)</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="image">
                                        <i class="fas fa-compass"></i>
                                    </div>
                                    <div class="text">
                                        <h6>Public or Private mode</h6>
                                        <p>Select if your content will stream Public or Private mode (PRO MEMBERS ONLY)</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="image">
                                        <i class="fas fa-compass"></i>
                                    </div>
                                    <div class="text">
                                        <h6>Earnings</h6>
                                        <p>Review & receive earnings for your content (PRO MEMBERS ONLY)</p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="col-md-6 ml-md-auto right-image-section">
                            <div class="icon-image">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <img class="right-image" src="{{ asset('frontend/img/works-section1.png') }}" alt="">
                        </div>
                    </div>

                    @include('frontend.inc.live')

                    <div class="right-works-section3 row">
                        <div class="col-md-12">
                            <h2>How jumcert works and registration process</h2>
                            <p>Aenean in mi ut enim fringilla porta id eget nulla. Nulla rutrum nisl id nisl finibus, et
                                feugiat orci porta. Aliquam erat volutpat. Nullam facilisis sed felis id condimentum.
                                Curabitur condimentum risus ultrices dignissim vehicula. Sed quis accumsan turpis. Morbi
                                lacinia tincidunt tellus, sed efficitur leo tincidunt nec</p>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="img/right-works-sec3.png" alt="">

                                <div class="text">
                                    <div class="icon-image">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <h6>Registration Process</h6>
                                    <p>Keep access to your entertainment content while roaming the world.Pick from
                                        thousands.</p>
                                    <a href="#">Join Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="img/right-works-sec3-2.png" alt="">

                                <div class="text">
                                    <div class="icon-image yellow-gradient">
                                        <i class="fas fa-film"></i>
                                    </div>
                                    <h6>Registration Process</h6>
                                    <p>Keep access to your entertainment content while roaming the world.Pick from
                                        thousands.</p>
                                    <a href="#">Upload Video</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="img/right-works-sec3-3.png" alt="">

                                <div class="text">
                                    <div class="icon-image">
                                        <i class="fas fa-compass"></i>
                                    </div>
                                    <h6>Registration Process</h6>
                                    <p>Keep access to your entertainment content while roaming the world.Pick from
                                        thousands.</p>
                                    <a href="#">Explore Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('frontend.inc.startsec') --}}
@endsection
