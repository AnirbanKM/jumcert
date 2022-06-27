@extends('backend.layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        {{-- Total No of. users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total No of. users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $allUsers->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total No of. free users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total No of. free users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $freeUser->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-meh fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total No of. pro users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total No of. pro users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $proUser->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-certificate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total No of. business users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total No of. business users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $businessUser->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-crown fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total earned by pro users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total earned by pro users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($proUser->count() * 19, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-certificate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total earned by business users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total earned by business users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($businessUser->count() * 50, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-crown fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total video uploaded by all users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total video uploaded by all users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $videos->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-video fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Live Stream created by all users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Live Stream created by all users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $liveStreams->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-stream fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Live Stream Completed --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                No. of Completed Live Stream
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $completedLiveStreams->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Live Stream Pending --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                No. of Pending Live Stream
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendingLiveStreams->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-hourglass fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Live Stream Cancelled --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                No. of Cancelled Live Stream
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $cancelledLiveStreams->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-window-close fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Live Stream Streaming --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                No. of Streaming Live Stream
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $streamingLiveStreams->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-stream fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->
@endsection
