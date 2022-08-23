@extends('layouts.app')

@section('frontendCss')
    <style>
        a {
            white-space: nowrap;
        }

        .table td,
        .table th {
            vertical-align: middle !important;
            white-space: nowrap !important;
        }

        h5 {
            margin: 10px 0px 10px 0;
        }
    </style>
@endsection

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">
                    <div class="row">

                        <div class="col-md-6">
                            @if ($user->stream_role == 'host')
                                <h5>Create your stream as host</h5>

                                <form action="{{ route('create_meeting') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Create Stream</button>
                                </form>
                            @else
                                <h5>You are audience</h5>
                            @endif
                        </div>

                        <div class="col-md-6">

                            @if ($user->stream_role == 'host')
                                <h5>Create your group as host</h5>

                                <a href="#" class="create_group btn btn-success">Create Group</a>
                            @else
                                <h5>You are audience</h5>
                            @endif

                        </div>


                        <div class="col-md-12">
                            <h5>Your streams</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">start_date</th>
                                            <th scope="col">end_date</th>
                                            <th scope="col">roomName</th>
                                            <th scope="col">roomUrl</th>
                                            <th scope="col">meetingId</th>
                                            <th scope="col">hostRoomUrl</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $item->start_date }}</td>
                                                <td>{{ $item->end_date }}</td>
                                                <td>{{ $item->roomName }}</td>
                                                <td>
                                                    <form action="#" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="meetingId"
                                                            value="{{ $item->meetingId }}" />
                                                        <button type="submit" class="btn btn-primary">
                                                            Audience Room Link
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>{{ $item->meetingId }}</td>
                                                <td>

                                                    @if ($user->stream_role == 'host')
                                                        <form action="#" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="meetingId"
                                                                value="{{ $item->meetingId }}" />
                                                            <button type="submit" class="btn btn-secondary">
                                                                Host Room Link
                                                            </button>
                                                        </form>
                                                    @else
                                                        Host Room Link is not available
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
