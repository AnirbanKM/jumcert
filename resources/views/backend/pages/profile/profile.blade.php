@extends('backend.layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Admin Profile</h1>

    <div class="row">

        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Address</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <td> {{ $admin->name }} </td>
                    <td> {{ $admin->email }} </td>
                    <td> {{ $admin->phone_no }} </td>
                    <td> {{ $admin->address }} </td>
                    <td> <button class="btn btn-primary adminProfileBtn" data-aid={{ $admin->id }}>
                            Edit
                        </button> 
                    </td>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="admin_profile_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change Admin Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('admin.update_admin_info') }}" method="POST">
                        @csrf
                        <input type="hidden" id="admin_id" name="id" />
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Enter name" id="name" name="name" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" placeholder="Enter email" id="email" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="pno">Phone No:</label>
                            <input type="text" class="form-control" placeholder="Enter phone no" id="pno" name="pno" />
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" name="address" id="address" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('adminjs')
    <script>
        jQuery(document).ready(function($) {

            $('body').on('click', '.adminProfileBtn', function() {

                var adminId = $(this).data("aid");
                $('#admin_id').val(adminId);

                $.ajax({
                    url: "{{ route('admin.get_admin_info') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {id: adminId},
                    success: function(resp) {
                        console.log(resp);
                        $('#name').val(resp.name);
                        $('#pno').val(resp.phone_no);
                        $('#email').val(resp.email);
                        $('#address').val(resp.address);
                        $("#admin_profile_modal").show().css('display', 'block').addClass('show');
                    }
                })                
            });


            $('.close').click(function() {
                $("#admin_profile_modal").hide().css('display', 'none').removeClass('show');
            });

        })
    </script>
@endsection
