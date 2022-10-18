@extends('backend.layouts.admin')

<style>
    table tr th,
    table tr td {
        text-align: center;
    }

    table tbody tr p {
        margin-bottom: 10px;
    }
</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Commission Page</h1>

    <div class="row">

        <div class="col-lg-12">
            <table id="table_id" class="display" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Admin <br /> Commission</th>
                        <th>Channel <br /> commission</th>
                        <th>Channel <br /> Name</th>
                        <th>Buyer <br /> Name</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commissions as $item)
                        <tr>
                            <td>
                                <p>${{ $item->admin_commission }}</p>
                            </td>
                            <td>
                                <p>${{ $item->user_commission }}</p>
                            </td>
                            <td>
                                <p>
                                    @isset($item->channelOwner)
                                        {{ $item->channelOwner->name }}
                                    @endisset
                                </p>
                            </td>
                            <td>
                                <p>{{ $item->buyer->name }}</p>
                            </td>
                            <td>
                                <p>{{ $item->created_at->diffforhumans() }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('adminjs')
    <script>
        jQuery(document).ready(function($) {

            $('#table_id').DataTable();

        });
    </script>
@endsection
