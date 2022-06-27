@extends('layouts.app')

@section('content')
    <section class="payment_sec">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-6 offset-lg-1">
                    <h3>Payment</h3>

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link p_card active" data-toggle="tab" href="#tabs-1" role="tab">
                                <img src="{{ asset('frontend/img/payments/card1.png') }}" alt="">
                                Credit card
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p_card" data-toggle="tab" href="#tabs-2" role="tab">
                                <img src="{{ asset('frontend/img/payments/card2.png') }}" alt="">
                                Debit card
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p_card" data-toggle="tab" href="#tabs-3" role="tab">
                                <img src="{{ asset('frontend/img/payments/card3.png') }}" alt="">
                                Paypal
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="card_frm">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Name on card">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Credit card number">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Expiration">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="CVV">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Save my payment
                                                    details
                                                    for future purchases</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="common_btn">Pay Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="card_frm">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Name on card">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Debit card number">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Expiration">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="CVV">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Save my payment
                                                    details
                                                    for future purchases</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="common_btn">Pay Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="card_frm">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Name on card">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Paypal">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Expiration">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="CVV">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Save my payment
                                                    details
                                                    for future purchases</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="common_btn">Pay Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="total_prev">
                        <img class="top" src="img/top.png" alt="">
                        <img class="bottom" src="img/top.png" alt="">
                        <h3>Payment Summary</h3>
                        <ul>
                            <li>Package <span>Pro</span></li>
                            <li>Price <span>$19.00</span></li>
                            <li>Discount <span>$2.00</span></li>
                            <li>Tax <span>$1.00</span></li>
                            <li class="total">Total <span>$18.00</span></li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('frontend.inc.startsec')
@endsection
