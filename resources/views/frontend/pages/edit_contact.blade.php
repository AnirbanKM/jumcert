@extends('layouts.app')

@section('content')
    @include('frontend.banner.banner')

    <section class="page_content personal-info-section1 edit-basic-section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="row right-personal-info-section1 right-edit-basic-section1 right-edit-contact-section1 ">

                        <div class="info-wrapper">
                            <h5>Basic info</h5>
                            <p>Some info may be visible to other people using Jumcert portal</p>

                            <form action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" placeholder="James Howard">
                                    </div>
                                    <div class="col-md-4 date-box">

                                        <input type="text" placeholder="10-05-1998" id="datepicker" autocomplete="off">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="col-md-4">
                                        <select>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>

                                    </div>
                                    <div class="col-md-12">
                                        <ul class="btn-sec">
                                            <li><button>Update Basic</button></li>
                                            <li><button class="cancel">Cancel</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="info-wrapper">
                            <h5>Contact info</h5>
                            <p>Some info may be visible to other people using Jumcert portal</p>
                            <form action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="email" placeholder="james@gmail.com">
                                    </div>
                                    <div class="col-md-4 date-box">
                                        <input type="email" placeholder="jameshoward@gmail.com">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="+91 9876 543 654">
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="btn-sec">
                                            <li><button>Update Basic</button></li>
                                            <li><button class="cancel">Cancel</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="info-wrapper">
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
                            <a href="#">Edit payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
