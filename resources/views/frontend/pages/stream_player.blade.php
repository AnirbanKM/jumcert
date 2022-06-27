@extends('layouts.app')

@section('content')
    <section class="page_content stream-player-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-6">

                    @include('frontend.inc.live')

                    <div class="video_desc">
                        <h3 class="title">Remaking our first cat scratching post</h3>
                        <p>
                            Aenean in mi ut enim fringilla porta id eget nulla. Nulla rutrum nisl id nisl finibus,
                            et feugiat orci porta. Aliquam erat volutpat. Nullam facilisis sed felis id condimentum.
                            Curabitur condimentum risus ultrices dignissim vehicula. Sed quis accumsan turpis. Morbi
                            lacinia tincidunt tellus, sed efficitur leo tincidunt nec
                        </p>
                        <h3>The Ultimate Guide To Sports</h3>
                        <p>
                            Etiam gravida euismod sodales. Vestibulum sed egestas sapien, sit amet iaculis eros.
                            Suspendisse pulvinar, erat sed interdum auctor, eros ligula tempus quam, in congue est
                            nunc et turpis. Nam non nisi sed sem placerat semper. Proin egestas, odio eu semper
                            mattis, enim odio pulvinar leo, ac vestibulum sapien nulla non arcu.
                            <br />
                            Mauris sed venenatis libero, Pellentesque elementum ante massa, ac ornare augue molestie
                            ut. Suspendisse lacinia tortor sem, at condimentum nulla auctor in. Sed vulputate
                            euismod risus, eget auctor nulla aliquet sed
                        </p>
                        <div class="quote">
                            <p>
                                Nullam id viverra elit, at posuere neque. Proin non semper nisl.
                                Etiam placerat, eros nec laoreet condimentum
                            </p>
                            <span>-john</span>
                        </div>
                        <p>
                            Nunc consequat quam tincidunt, mattis purus et, euismod eros. Donec sed lobortis nunc.
                            Donec a pretium ipsum. Curabitur pellentesque neque et dictum interdum. Nam eu faucibus
                            augue, id sagittis magna. Aliquam sodales est dolor, non convallis arcu feugiat a.
                            Curabitur dictum dapibus nisl quis convallis. Morbi nec ex vestibulum, tincidunt sapien
                            a, pretium arcu.
                        </p>
                        <h3>The Ultimate Guide To Sports</h3>
                        <ul>
                            <li>
                                Suspendisse gravida risus in sapien sollicitudin, quis pulvinar neque congue.
                            </li>
                            <li>
                                Quisque mollis enim nec lacus elementum vulputate.
                            </li>
                            <li>
                                Nullam fermentum turpis a nisl tristique, quis rutrum quam eleifend.
                            </li>
                            <li>
                                Donec placerat orci id lobortis suscipit.
                            </li>
                            <li>
                                Fusce quis massa rutrum, accumsan nibh vitae, hendrerit turpis.
                            </li>
                            <li>
                                Etiam dignissim mauris at orci finibus, quis blandit nisl cursus.
                            </li>
                        </ul>
                        <p>
                            Aenean in mi ut enim fringilla porta id eget nulla. Nulla rutrum nisl id nisl finibus,
                            et feugiat orci porta. Aliquam erat volutpat. Nullam facilisis sed felis id condimentum.
                            Curabitur condimentum risus ultrices dignissim vehicula. Sed quis accumsan turpis. Morbi
                            lacinia tincidunt tellus, sed efficitur leo tincidunt nec. Pellentesque ac lorem
                            egestas, volutpat neque et, ullamcorper est.
                        </p>
                    </div>

                    <div class="comment_sec">
                        <h3>Leave a comment</h3>
                        <p>
                            There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour.
                        </p>
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="common_btn">SEND</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-lg-3 right_sidebar">

                    <div class="each_box">
                        <img src="{{ asset('frontend/img/stream_player/s1.png') }}" alt="">
                        <a href="">
                            <h6>Dubai Racing</h6>
                            <h5>Bayley Robertson</h5>
                            <p>478 Views • 3 mon. ago</p>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
