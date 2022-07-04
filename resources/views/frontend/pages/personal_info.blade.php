@extends('layouts.app')

<style>
    span {
        text-align: left;
        display: block;
        padding-left: 10px
    }

    #editModalDiv form li {
        width: 100%;
    }

    #editModalDiv form button {
        display: block;
        margin: 0 auto;
    }

    .personal-info-section1 .right-personal-info-section1 .info-wrapper ul li {
        margin-right: 30px !important;
    }
</style>

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content personal-info-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>
                <div class="col-lg-9">

                    <div class="row right-personal-info-section1">

                        <h2>Personal info
                            @if ($user->userprofile !== null)
                                <span class="badge badge-success" style="font-size: 12px; font-weight: 700;">
                                    Your profile info is created.
                                </span>
                            @else
                                <span class="badge badge-danger" style="font-size: 12px; font-weight: 700;">
                                    You need to create your profile info.
                                </span>
                            @endif

                        </h2>
                        <p>Info about you and your preferences across Jumcert portal</p>

                        <div class="info-wrapper">
                            <h5>Basic info</h5>
                            <p>Some info may be visible to other people using Jumcert portal</p>

                            <ul>
                                <li>
                                    <h5>Name</h5>
                                    <h6> {{ auth()->user()->name }} </h6>
                                </li>
                                <li>
                                    <h5>Birthday</h5>
                                    <h6 id="uPdob">---</h6>
                                </li>
                                <li>
                                    <h5>Gender</h5>
                                    <h6 id="upGender">---</h6>
                                </li>
                            </ul>
                            <a href="#" id="edit_basic">Edit Basic</a>
                        </div>

                        <div class="info-wrapper">
                            <h5>Contact info</h5>
                            <p>Some info may be visible to other people using Jumcert portal</p>

                            <ul>
                                <li>
                                    <h5>Email</h5>
                                    <h6>{{ auth()->user()->email }}</h6>
                                </li>
                                <li>
                                    <h5>Secondary Email</h5>
                                    <h6 id="usEmail">---</h6>
                                </li>
                                <li>
                                    <h5>Phone</h5>
                                    <h6 id="upPhone">---</h6>
                                </li>
                            </ul>
                        </div>

                        <div class="info-wrapper d-none">
                            <h5>Payments & subscriptions</h5>
                            <p>Your payment info, transactions, recurring payments, and reservations
                            </p>

                            <ul>
                                <li>
                                    <h5>Card Type</h5>
                                    <h6>Credit Card</h6>
                                </li>
                                <li>
                                    <h5>Card Number</h5>
                                    <h6>123X XXXX XXX7</h6>
                                </li>
                                <li>
                                    <h5>Name Holder</h5>
                                    <h6>James Howard</h6>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal edit-basic-modal modal" id="editModalDiv" tabindex="-1" role="dialog" aria-labelledby="basicModal"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">User Profile </h4>
                    <button type="button" class="close" id="editModalClose">
                        <span id="fg" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="info-wrapper">
                        <h5>Basic info</h5>
                        <p>Some info may be visible to other people using Jumcert portal</p>

                        <form action="{{ route('user_info_create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="mb-0" placeholder="user name" id="name"
                                            name="name">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="col-md-12 date-box">
                                    <input type="date" placeholder="DOB" id="dob" autocomplete="off"
                                        name="birthday">
                                </div>
                                <div class="col-md-12">
                                    <select name="gender" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-12 date-box">
                                    <input type="email" placeholder="Primary Email" id="p_email" name="email">
                                </div>
                                <div class="col-md-12 date-box">
                                    <input type="email" placeholder="Secondary Email" id="s_email"
                                        name="secondary_email">
                                </div>
                                <div class="col-md-12 date-box">
                                    <input type="text" placeholder="Phone No" id="phone" name="phone">
                                </div>
                                <div class="col-md-12 date-box">
                                    <textarea placeholder="write your adddress (Optional)" id="address" name="address" rows="3"></textarea>
                                </div>
                                <div class="col-md-12 upload-here-sec">
                                    <div class="col-md-6 upload-image-sec">
                                        <div class="icon-upload" style="min-height: 100%;">
                                            <img src="{{ asset('frontend/img/upload.png') }}" alt="">
                                            <h6>Upload</h6>
                                        </div>
                                        <input type="file" class="custom-file-input" name="profileImage">
                                    </div>
                                    <div class="col-md-6 align-items-center">
                                        <img src="{{ asset('frontend/img/user.png') }}" id="prevImg"
                                            style=" object-fit: cover;border-radius: 100%;height: 100px;width: 100px;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <ul class="btn-sec"
                                        style="display: flex;justify-content: space-between;margin-top: 1.2rem;">
                                        <li><button>Update Basic</button></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('frontendJs')
    <script>
        jQuery(document).ready(function($) {

            $('body').on('click', '#edit_basic', function(e) {
                e.preventDefault();
                $('#editModalDiv').show();

                $.ajax({
                    url: "{{ route('get_user_info') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(resp) {
                        // console.log(resp);
                        if (resp.status == false) {
                            console.log(resp);
                        } else {
                            $.ajax({
                                url: "{{ route('get_user_info') }}",
                                type: 'GET',
                                dataType: 'json',
                                success: function(resp) {
                                    console.log(resp);
                                    $('#name').val(resp.name);
                                    $('#dob').val(resp.birthday);
                                    $('#p_email').val(resp.email);
                                    $('#s_email').val(resp.secondary_email);
                                    $('#phone').val(resp.phone);
                                    $('#address').val(resp.address);
                                    $('#gender').html(resp.gender);

                                    var imgPath = resp.image;
                                    var setpath = imgPath.replace('public',
                                        'storage');
                                    $('#prevImg').attr('src', setpath);

                                    // $('#uPdob').text(resp.birthday);

                                }
                            });

                        }
                    }
                });
            });

            $('#editModalClose').click(function() {
                $('#editModalDiv').hide();
            });

            function fillinfo() {
                $.ajax({
                    url: '{{ route('get_user_info') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(resp) {
                        if (resp !== "") {
                            $('#uPdob').text(resp.birthday);
                            $('#upGender').text(resp.ugender);
                            $('#usEmail').text(resp.secondary_email);
                            $('#upPhone').text(resp.phone);
                        }
                    }
                })
            }
            fillinfo();

        });
    </script>
@endsection
