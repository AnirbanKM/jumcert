@extends('layouts.app')

@section('content')
    <section class="page_content about-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row right-homepage-section1">
                        <div class="col-md-12">
                            <div class="heading">
                                <h2>Reset your password</h2>
                            </div>

                            <form action="{{ route('reset_password') }}" method="POST">
                                @csrf

                                <div class="row justify-content-center">

                                    <div class="col-6">

                                        <input type="hidden" name="emailtoken" value={{ $token }} />

                                        <div class="form-group">
                                            <label for="email">Enter Email address</label>

                                            <input type="text" placeholder="Enter email" class="form-control"
                                                class="mb-0" name="email" id="email" />

                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Enter password</label>

                                            <input type="text" placeholder="Enter password" class="form-control"
                                                class="mb-0" name="password" id="password" />

                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cpassword">Enter confirm password</label>

                                            <input type="text" placeholder="Enter confirm password" class="form-control"
                                                class="mb-0" name="cpassword" id="cpassword" />

                                            @error('cpassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 p-0 text-center">
                                            <input type="submit" class="btn btn-primary" value="Reset Password">
                                        </div>

                                    </div>

                                </div>


                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection
