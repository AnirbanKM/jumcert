@extends('backend.layouts.admin')

<style>
    table tbody tr td a,
    table tbody tr td button {
        margin-bottom: 20px;
    }

    table tbody tr td img {
        margin-bottom: 10px;
        border: 3px solid #4e73df;
        border-radius: 5px;
    }

    img {
        width: 150px;
        object-fit: cover;
    }

</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">View all users</h1>

    <div class="row">
        <div class="col-12">

            <table id="table_id" class="display" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                @if ($user->user_role == 0)
                                    Free
                                @elseif($user->user_role == 1)
                                    Pro
                                @else
                                    Business
                                @endif

                            </td>
                            <td>
                                @if ($user->userprofile == null)
                                    <img src="{{ asset('user.png') }}" class="user_img" alt="" />
                                @else
                                    <img src="{{ $user->userprofile->image }}" class="user_img" alt="" />
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.user_info', $user->id) }}" target="_blank"
                                    class="btn btn-primary">
                                    View user info
                                </a>
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
        })
    </script>
@endsection
