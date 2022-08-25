@extends('layouts.app')

<style>

</style>

@section('content')
    <section class="page_content connections-section1 videos-section1 channel-section1 about-section1">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    @include('frontend.inc.sidebar')
                </div>

                <div class="col-lg-9">

                    <div class="row rounded right-connections-section1 right-videos-section1 right-homepage-section1">
                        <div class="col-md-12">

                            <ul class="nav tab-section" id="myTab" role="tablist">
                                <li>
                                    <a class="nav-link active" id="user-account-tab" data-toggle="tab" href="#user_account"
                                        role="tab" aria-controls="user_account" aria-selected="false">
                                        User account
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" id="stipe-dashboard-tab" data-toggle="tab" href="#stipe_dashboard"
                                        role="tab" aria-controls="stipe_dashboard" aria-selected="false">
                                        Update Your Connected Account
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" id="bank-account-tab" data-toggle="tab" href="#bank_account"
                                        role="tab" aria-controls="bank_account" aria-selected="false">
                                        Update Your Connected Account's Bank Info
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" id="all-transaction-tab" data-toggle="tab" href="#all_transaction"
                                        role="tab" aria-controls="all_transaction" aria-selected="false">
                                        My Earnings
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="user_account" role="tabpanel"
                                    aria-labelledby="user_account">

                                    @if ($account != null)
                                        <h1 style="color: #1c1c1c;">
                                            Account ID: {{ $account->connected_account_id }}
                                        </h1>
                                    @else
                                        <form action="{{ route('stripe_create_account') }}" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-primary" value="Create Your Account" />
                                        </form>
                                    @endif

                                </div>

                                <div class="tab-pane fade" id="stipe_dashboard" role="tabpanel"
                                    aria-labelledby="stipe_dashboard">

                                    <div class="heading">
                                        <h2>Update your connected account with correct info</h2>
                                    </div>

                                    <form action="{{ route('update_connected_account') }}" method="POST">

                                        @csrf

                                        <h6 style="color: #1c1c1c;">Account Email</h6>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" placeholder="Business email" class="form-control"
                                                value="test@gmail.com" name="email" id="email">
                                        </div>

                                        <hr />

                                        <h6 style="color: #1c1c1c;">Company Address Info</h6>

                                        <div class="form-group">
                                            <label for="companycountry">Company Address Country</label>
                                            <input type="text" placeholder="Country Name" class="form-control"
                                                value="US" name="company_country" id="companycountry">
                                        </div>

                                        <div class="form-group">
                                            <label for="companystate">Company Address State</label>
                                            <input type="text" placeholder="State Name" class="form-control"
                                                value="Florida" name="company_state" id="companystate">
                                        </div>

                                        <div class="form-group">
                                            <label for="companycity">Company Address City</label>
                                            <input type="text" placeholder="City Name" class="form-control"
                                                value="Jacksonville" name="company_city" id="companycity">
                                        </div>

                                        <div class="form-group">
                                            <label for="companypostalcode">Company Postal Code</label>
                                            <input type="text" placeholder="Postal Code" class="form-control"
                                                value="32217" name="company_postal_code" id="companypostalcode">
                                        </div>

                                        <div class="form-group">
                                            <label for="companyline1">Company Address line1</label>
                                            <input type="text" placeholder="Address line1" class="form-control"
                                                value="6028 Chester avu" name="company_line1" id="companyline1">
                                        </div>

                                        <div class="form-group">
                                            <label for="companyline2">Company Address line2</label>
                                            <input type="text" placeholder="Address line2" class="form-control"
                                                value="Suite 201" name="company_line2" id="companyline2">
                                        </div>

                                        <hr />

                                        <h6 style="color: #1c1c1c;">Business Profile</h6>

                                        <div class="form-group">
                                            <label for="businessprofile1">Business Profile Name</label>
                                            <input type="text" placeholder="Business Profile Name"
                                                class="form-control" value="Jumcert Business" name="b_profile_name"
                                                id="businessprofile1">
                                        </div>

                                        <div class="form-group">
                                            <label for="businessprofile2">Business Product Description</label>
                                            <input type="text" placeholder="Business Profile Description"
                                                class="form-control" value="Jumcert Business Desc" name="b_profile_desc"
                                                id="businessprofile2">
                                        </div>

                                        <hr />

                                        <h6 style="color: #1c1c1c;">Account Holder DOB</h6>

                                        <div class="form-group">
                                            <label for="dob1">DOB Day</label>
                                            <input type="text" placeholder="Enter DOB Day" class="form-control"
                                                value="05" name="dob_day" id="dob1">
                                        </div>

                                        <div class="form-group">
                                            <label for="dob2">DOB Month</label>
                                            <input type="text" placeholder="Enter DOB month" class="form-control"
                                                value="07" name="dob_month" id="dob2">
                                        </div>

                                        <div class="form-group">
                                            <label for="dob3">DOB Year</label>
                                            <input type="text" placeholder="Enter DOB year" class="form-control"
                                                value="1997" name="dob_year" id="dob3">
                                        </div>

                                        <hr />

                                        <h6 style="color: #1c1c1c;">Individual Address Info</h6>

                                        <div class="form-group">
                                            <label for="iaddress1">Individual Address State</label>
                                            <input type="text" placeholder="Enter State" class="form-control"
                                                value="Florida" name="i_address_state" id="iaddress1">
                                        </div>

                                        <div class="form-group">
                                            <label for="iaddress2">Individual Address city</label>
                                            <input type="text" placeholder="Enter city" class="form-control"
                                                value="Jacksonville" name="i_address_city" id="iaddress2">
                                        </div>

                                        <div class="form-group">
                                            <label for="iaddress3">Individual Address line1</label>
                                            <input type="text" placeholder="Enter line 1" class="form-control"
                                                value="6028 Chester avu" name="i_address_line1" id="iaddress3">
                                        </div>

                                        <div class="form-group">
                                            <label for="iaddress4">Individual Address postal code</label>
                                            <input type="text" placeholder="Enter postal code" class="form-control"
                                                value="32217" name="i_address_postal_code" id="iaddress4">
                                        </div>

                                        <hr />

                                        <h6 style="color: #1c1c1c;">Individual User Info</h6>

                                        <div class="form-group">
                                            <label for="iuser1">Individual First Name</label>
                                            <input type="text" placeholder="Enter First Name" class="form-control"
                                                value="Anirban" name="i_user_first_name" id="iuser1">
                                        </div>

                                        <div class="form-group">
                                            <label for="iuser2">Individual Last Name</label>
                                            <input type="text" placeholder="Enter Last Name" class="form-control"
                                                value="Show" name="i_user_last_name" id="iuser2">
                                        </div>

                                        <div class="form-group">
                                            <label for="iuser3">Individual Email</label>
                                            <input type="text" placeholder="Enter Email" class="form-control"
                                                value="anirbankm@gmail.com" name="i_user_email" id="iuser3">
                                        </div>

                                        <div class="form-group">
                                            <label for="iuser4">Individual Phone</label>
                                            <input type="text" placeholder="Enter Phone" class="form-control"
                                                value="(986) 542-1155" name="i_user_Phone" id="iuser4">
                                        </div>

                                        <div class="form-group">
                                            <label for="iuser5">Individual ssn last 4</label>
                                            <input type="text" placeholder="Enter ssn last 4" class="form-control"
                                                value="0000" name="i_user_ssn_last_4" id="iuser5">
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Update Account">
                                    </form>

                                </div>

                                <div class="tab-pane fade" id="bank_account" role="tabpanel"
                                    aria-labelledby="bank_account">

                                    <div class="heading">
                                        <h2>Please enter your bank accout info</h2>
                                    </div>

                                    <form action="{{ route('add_bank_account') }}" method="POST">

                                        @csrf

                                        <div class="form-group">
                                            <label for="country">Enter Country</label>
                                            <input type="country" placeholder="Business country" class="form-control"
                                                value="us" name="country" id="country">
                                        </div>

                                        <div class="form-group">
                                            <label for="currency">Enter Country</label>
                                            <input type="currency" placeholder="Business currency" class="form-control"
                                                value="usd" name="currency" id="currency">
                                        </div>

                                        <div class="form-group">
                                            <label for="routing_number">Enter Routing Number</label>
                                            <input type="routing_number" placeholder="Business routing number"
                                                class="form-control" value="110000000" name="routing_number"
                                                id="routing_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="account_number">Enter Routing Number</label>
                                            <input type="account_number" placeholder="Business account number"
                                                class="form-control" value="000123456789" name="account_number"
                                                id="account_number">
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Update Bank Account">
                                    </form>

                                </div>

                                <div class="tab-pane fade" id="all_transaction" role="tabpanel"
                                    aria-labelledby="all_transaction">

                                    @php
                                        $x = 0;

                                        if (count($owner_videos) > 0) {
                                            foreach ($owner_videos as $item) {
                                                $x = $x + $item->price;
                                            }

                                            $owner_commission = ($x * 81) / 100;
                                        } else {
                                            $owner_commission = 0;
                                        }
                                    @endphp

                                    <div class="heading">
                                        <h2>Your total earning : ${{ $owner_commission }}</h2>
                                    </div>

                                    @if (count($owner_videos) > 0)
                                        <div class="table-responsive">
                                            <table class="table display" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($owner_videos as $item)
                                                        <tr>
                                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                                            <td>{{ $item->title }}</td>
                                                            <td>
                                                                <img src="{{ $item->thumbnail }}" alt=""
                                                                    style="width: 100px;" />
                                                            </td>
                                                            <td>
                                                                ${{ ($item->price * 81) / 100 }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                            {!! $owner_videos->links() !!}

                                        </div>
                                    @else
                                        <h1 style="color: #1c1c1c;">
                                            Currently you have no earning.
                                        </h1>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('frontendJs')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
