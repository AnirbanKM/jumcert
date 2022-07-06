@extends('backend.layouts.admin')

<style>
    table tr th,
    table tr td {
        text-align: center !important;
    }

    table tbody tr p {
        margin-bottom: 10px;
    }
</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Payment Info</h1>

    <div class="row">
        <div class="col-12">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="display" style="width: 100%;">
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

                                    @if (@isset($user->usersPayment))
                                        <td> {{ $user->usersPayment->status }}</td>
                                        <td> {{ $user->usersPayment->payment_id }}</td>
                                    @else
                                        <td> -- </td>
                                        <td> -- </td>
                                    @endif

                                    @if (@isset($user->usersOrders))
                                        <td> {{ $user->usersOrders->price }}</td>
                                        <td> {{ $user->usersOrders->created_at }}</td>
                                    @else
                                        <td> -- </td>
                                        <td> -- </td>
                                    @endif
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
            jQuery(document).ready(function() {
                $('#table_id').DataTable();
            });
        </script>
    @endsection
