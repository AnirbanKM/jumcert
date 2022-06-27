@extends('backend.layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Payment Info</h1>

    <div class="row">

        <div class="col-12">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" class="display" id="paymentTableId" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>User Role</th>
                                <th>Status</th>
                                <th>Payment Id</th>
                                <th>Price</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td> {{ $user->name }} </td>
                                    <td>
                                        @if ($user->user_role == 0)
                                            Free
                                        @elseif($user->user_role == 1)
                                            Pro
                                        @elseif($user->user_role == 2)
                                            Business
                                        @endif
                                    </td>

                                    @isset($user->usersPayment)
                                        <td> {{ $user->usersPayment->status }}</td>
                                        <td> {{ $user->usersPayment->payment_id }}</td>
                                    @endisset

                                    @isset($user->usersOrders)
                                        <td> {{ $user->usersOrders->price }}</td>
                                        <td> {{ $user->usersOrders->created_at }}</td>
                                    @endisset
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('adminjs')
        <script>
            jQuery(document).ready(function($) {
                // $('#paymentTableId').DataTable();
            })
        </script>
    @endsection
