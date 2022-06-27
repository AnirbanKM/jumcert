@extends('backend.layouts.admin')

<style>
    form span {
        color: red;
    }

</style>

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Change Password</h1>

    <div class="row">
        <div class="col-6">
            <form action="{{ route('admin.admin_pass_upd') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $admin->id }}" name="id" />

                <div class="form-group">
                    <label for="currentPass">Enter current password:</label>
                    <input type="password" class="form-control" placeholder="Enter current password"
                        name="current_password" id="currentPass" />
                </div>
                <div class="form-group">
                    <label for="pass">Enter new password:</label>
                    <input type="password" class="form-control" placeholder="Enter new password" name="password"
                        id="pass" />
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cpass">Confirm new password:</label>
                    <input type="password" class="form-control" placeholder="Confirm new password" name="cpassword"
                        id="cpass" />
                    @error('cpassword')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 p-0">
                    <input type="submit" class="ml-auto d-block btn btn-primary" value="Change Password" />
                </div>
            </form>
        </div>
    </div>
@endsection


@section('adminjs')
    <script></script>
@endsection
