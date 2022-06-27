<!DOCTYPE html>
<html lang="en">

<head>

    @include('backend.inc.header')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form id="adminLoginFrm">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user email"
                                                name="email" placeholder="Enter Email Address...">
                                            <span class="text-left d-block" id="logEmailErr"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user pass"
                                                name="password" placeholder="Password">
                                            <span class="text-left d-block" id="logPassErr"></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="rememderCheck"
                                                    id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('backend.inc.footer')

    @if (session()->has('success'))
        <script>
            new Noty({
                theme: 'sunset',
                type: 'success',
                layout: 'topRight',
                text: "{{ session()->get('success') }}",
                timeout: 3000,
                closeWith: ['click', 'button']
            }).show();
        </script>
    @endif

    <script>
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

            $('body').on('submit', '#adminLoginFrm', function(e) {
                e.preventDefault();

                var form = $("#adminLoginFrm");
                var logEmail = $('.email').val();
                var logPass = $('.pass').val();


                if (logEmail == "") {
                    $("#logEmailErr").addClass('text-danger');
                    $("#logEmailErr").text('Email id cannot be blank');
                } else {
                    $("#logEmailErr").removeClass('text-danger');
                    $("#logEmailErr").addClass('text-success');
                    $("#logEmailErr").text('Looking good...');

                    if (logPass == "") {
                        $("#logPassErr").addClass('text-danger');
                        $("#logPassErr").text('Password cannot be blank');
                    } else {
                        $("#logPassErr").removeClass('text-danger');
                        $("#logPassErr").addClass('text-success');
                        $("#logPassErr").text('alright we are good go.........');

                        $.ajax({
                            url: "{{ route('admin.login_check') }}",
                            type: "POST",
                            data: form.serialize(),
                            dataType: "json",
                            success: function(resp) {
                                console.log(resp);

                                if (resp.status == '200' && resp.result == true) {

                                    window.location.href = "{{ route('admin.dashboard') }}";
                                    notification(resp.message, "success");

                                } else if (resp.status == '401' && resp.result == false) {

                                    notification(resp.message, "error");
                                    setTimeout(function() {
                                        location.reload();
                                    }, 3000);

                                } else {

                                    location.reload();
                                    notification("don't try to hack", "error");

                                }

                            }
                        });
                    }
                }
            });

        });
    </script>

</body>

</html>
