@extends('backend.layouts.admin')

<style>
    table tr th,
    table tr td {
        text-align: center;
    }
</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Set your commission</h1>

    <div class="row">

        <div class="col-md-4">
            <form id="updCommission">
                @csrf
                <div class="form-group">
                    <label for="srole">Select Role</label>
                    <select class="form-control" id="srole" name="role">
                        @foreach($commission as $item) 
                            <option value="{{ $item->id }}"> {{ $item->role }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Commission :</label>
                    <input type="number" class="form-control" min="1" placeholder="Update Commission" name="commission" />
                    <span class="text-left d-block"></span>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <div class="col-md-8">
           
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Role</th>
                            <th scope="col">Admin Commission</th>
                            <th scope="col">User Commission</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pro</td>
                            <td> <p id="acomProid" class="badge badge-pill badge-success"> </p> </td>
                            <td> <p id="ucomProid" class="badge badge-pill badge-dark"> </p> </td>
                        </tr>
                        <tr>
                            <td>Business</td>
                            <td> <p id="acomBusinessid" class="badge badge-pill badge-success"> </p> </td>
                            <td> <p id="ucomBusinessid" class="badge badge-pill badge-dark"> </p> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
      
        </div>
    </div>
@endsection

@section('adminjs')
    <script>
        $(document).ready(function() {

            $('body').on('submit', '#updCommission', function(event) {
                event.preventDefault();

                var form = $("#updCommission");

                $.ajax({
                    url: "{{ route('admin.update_commission') }}",
                    type: "POST",
                    data: form.serialize(),
                    dataType: "json",
                    success: function(resp) {
                        // console.log(resp);
                        $('#updCommission')[0].reset()
                        fetch_commission();
                    }
                })
            });

            fetch_commission();

            function fetch_commission() {
                $.ajax({
                    url: "{{ route('admin.fetch_commission_info') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(resp) {
                        // console.log(resp.obj);

                        // Set Pro VS Admin Commision
                        $('#acomProid').text(resp.obj[0].acommission);
                        $('#ucomProid').text(resp.obj[0].ucommission);

                        // Set Business VS Admin Commision
                        $('#acomBusinessid').text(resp.obj[1].acommission);
                        $('#ucomBusinessid').text(resp.obj[1].ucommission);
                    }
                })
            }

        }); 
    </script>
@endsection
