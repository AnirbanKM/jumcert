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
                                <h2>Stripe Payment Info
                                    @if (count($data) > 0)
                                        <span class="badge badge-success" style="font-size: 12px; font-weight: 700;">
                                            Your account is created.
                                        </span>
                                    @else
                                        <span class="badge badge-danger" style="font-size: 12px; font-weight: 700;">
                                            Your need to create your account your account.
                                        </span>
                                    @endif
                                </h2>
                            </div>

                            @if (Session::has('error'))
                                <span class="badge badge-danger"
                                    style="font-size: 12px; font-weight: 700; white-space: normal; text-align: left;">
                                    {{ session::get('error') }}
                                </span>
                            @endif

                            @if (count($data) > 0)
                                <h3 class="text-uppercase text-info">Your already added your account</h3>
                            @else
                                <form action="{{ route('create_payment_info') }}" method="POST">
                                    @csrf

                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="country">Enter Country Code</label>

                                                <input type="text" placeholder="Enter country" value="US"
                                                    class="form-control" class="mb-0" name="country" id="country"
                                                    readonly />

                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="currency">Enter Currency</label>

                                                <input type="text" placeholder="Enter currency" value="USD"
                                                    class="form-control" class="mb-0" name="currency" id="currency"
                                                    readonly />

                                                @error('currency')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="accountholdername">Account holder name</label>
                                                <input type="text" placeholder="Account holder name" class="form-control"
                                                    class="mb-0" name="account_holder_name" id="accountholdername" />
                                                @error('account_holder_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="accountholdertype">Account holder type</label>

                                                <select class="form-control mb-0" id="accountholdertype"
                                                    name="account_holder_type">
                                                    <option value="individual">Individual</option>
                                                    <option value="company">Company</option>
                                                </select>

                                                @error('account_holder_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="routingnumber">Routing number</label>
                                                <input type="number" placeholder="Routing number" class="form-control"
                                                    class="mb-0" name="routing_number" id="routingnumber">
                                                @error('routing_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="accountnumber">Account number</label>
                                                <input type="number" placeholder="Account number" class="form-control"
                                                    class="mb-0" name="account_number" id="accountnumber">
                                                @error('account_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p-0 text-right">
                                        <input type="submit" class="btn btn-primary" value="Create">
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>

                    @if (count($data) > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Accunt holder name</th>
                                                <th>Accunt holder type</th>
                                                <th>Bank name</th>
                                                <th>Country</th>
                                                <th>Currency</th>
                                                <th>Time</th>
                                                <th>delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td> {{ $item->account_holder_name }} </td>
                                                    <td> {{ $item->account_holder_type }} </td>
                                                    <td> {{ $item->bank_name }} </td>
                                                    <td> {{ $item->country }} </td>
                                                    <td> {{ $item->currency }} </td>
                                                    <td> {{ $item->created_at->diffForHumans() }} </td>
                                                    <td>
                                                        <form action="{{ route('del_payment_info') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value={{ $item->id }} />
                                                            <input type="submit" value="Delete" class="btn btn-danger" />
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </section>
@endsection

@section('frontendJs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
        < />

        <
        script >
            jQuery(document).ready(function($) {

                function notification(resp, status) {
                    new Noty({
                        theme: 'sunset',
                        type: status,
                        layout: 'topRight',
                        text: resp,
                        timeout: 3000,
                        closeWith: ['click', 'button']
                    }).show();
                }

                $('.countrycode').select2();
                $('.currencycode').select2();

            }); <
        />
    @endsection
