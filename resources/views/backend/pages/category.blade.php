@extends('backend.layouts.admin')

<style>
    table tbody tr td a,
    table tbody tr td button {
        margin-bottom: 20px;
    }

    table tbody tr td img {
        background: #d08383;
        padding: 10px;
    }

</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Category Page</h1>

    <div class="row">

        <div class="col-md-4">
            <form action="{{ route('admin.add_category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="cat">Category Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Category" name="name">
                    <span class="text-left d-block"></span>
                </div>
                <div class="form-group">
                    <label for="cat">Category Icon:</label>
                    <input type="file" class="form-control" placeholder="Enter Category" name="catIcon">
                    <span class="text-left d-block"></span>
                </div>
                <div class="form-group">
                    <label for="catdesc">Category Desciption:</label>
                    <textarea class="form-control" name="desc" rows="3" placeholder="Enter category desciption"></textarea>
                    <span class="text-left d-block"></span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-lg-8">
            <table id="table_id" class="display" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td> {{ $category->name }} </td>
                            <td>
                                {{ Str::limit($category->desc, 10) }}
                            </td>
                            <td>
                                <img src="{{ route('home') }}/{{ str_replace('public', 'storage', $category->icon) }}"
                                    alt="" />
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-info" id="updatecategory"
                                    data-eid="{{ $category->id }}">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger" id="delcategory" data-id="{{ $category->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="edit_cat_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Language</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('admin.update_category') }}" method="POST">
                        @csrf
                        <input type="hidden" id="cat_id" name="id" />
                        <div class="form-group">
                            <label for="edit-lang-text-modal">Enter Category:</label>
                            <input type="text" class="form-control" placeholder="Enter category" id="catname" name="name">
                        </div>
                        <div class="form-group">
                            <label for="catdesc">Category Desciption:</label>
                            <textarea class="form-control" name="desc" id="catdesc-id" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('adminjs')
    <script>
        jQuery(document).ready(function($) {

            $('#table_id').DataTable();

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

            $('body').on('click', '#delcategory', function(e) {
                var cat_id = $(this).data("id");
                var x = confirm("Are You sure want to delete !");

                if (x) {
                    $.ajax({
                        url: "{{ route('admin.del_category') }}",
                        type: "GET",
                        data: {
                            id: cat_id
                        },
                        dataType: "json",
                        success: function(resp) {
                            console.log(resp);
                            if (resp.status == 200 && resp.success != "") {
                                notification(resp.success, 'success');
                                setTimeout(() => {
                                    window.reload();
                                }, 2000);
                            } else {
                                notification(resp.success, 'error');
                            }
                        }
                    })
                }
            })

            $('body').on('click', '#updatecategory', function(e) {
                e.preventDefault();
                var cat_id = $(this).data("eid");

                $.ajax({
                    url: "{{ route('admin.get_category') }}",
                    type: "GET",
                    data: {
                        id: cat_id
                    },
                    dataType: "json",
                    success: function(resp) {
                        $("#cat_id").val(resp.id);
                        $("#catname").val(resp.name);
                        $("#catdesc-id").val(resp.desc);
                        $("#edit_cat_modal").modal('show');
                    },
                })
            })

        });
    </script>
@endsection
