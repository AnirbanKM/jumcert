<!-- log-in -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Login to Jumcert</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Login to Jumcert account with your email address
                    and password created during registration.</p>
                <form id="loginFrm">
                    @csrf

                    <div class="form-group">
                        <input type="email" name="email" class="logEmail mb-0" placeholder="Email Address">
                        <span class="text-left d-block" id="logEmailErr"></span>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="logPass mb-0" placeholder="Password">
                        <span class="text-left d-block" id="logPassErr"></span>
                    </div>

                    <input type="submit" value="Login to Jumcert">

                    <a href="javascript:;" class="forgot-pass" data-toggle="modal" data-target="#resetpass">
                        Forgot Password
                    </a>
                    <p class="log-bg">Or Login with</p>
                    <a href="#" class="mod-btn fb-btn"> <img src="{{ asset('frontend/img/fb.png') }}"
                            alt="">
                        Sign In with Facebook
                    </a>
                    <a href="#" class="mod-btn ggl-btn"><img src="{{ asset('frontend/img/google.png') }}"
                            alt="">
                        Sign In with Google</a>
                    <p class="reg-link">Don’t have an account?
                        <a href="" data-toggle="modal" data-target="#smallModal2">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- register -->
<div class="modal fade" id="smallModal2" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Register to Jumcert</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Login to Jumcert account with your email address
                    and password created during registration.
                </p>

                <form id="registerForm">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="mb-0" name="name" id="username" placeholder="Username">
                        <p class="m-0 text-left" id="nameErr"></p>
                    </div>
                    <div class="form-group">
                        <input type="email" class="mb-0" name="email" id="email" placeholder="Email">
                        <p class="text-danger m-0 text-left" id="emailErr"></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="mb-0" name="password" id="password" placeholder="Password">
                        <p class="text-danger m-0 text-left" id="passErr"></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="mb-0" name="password_confirmation" id="confirm_password"
                            placeholder="Confirm Password">
                        <p class="text-danger m-0 text-left" id="cpassErr"></p>
                    </div>
                    <input type="submit" value="Register to Jumcert" id="regBtn">

                    <a href="javascript:;" class="forgot-pass" data-toggle="modal" data-target="#resetpass">
                        Forgot Password
                    </a>
                    <p class="log-bg">Or Login with</p>
                    <a href="#" class="mod-btn fb-btn"> <img src="{{ asset('frontend/img/fb.png') }}"
                            alt="">
                        Sign In with Facebook
                    </a>
                    <a href="#" class="mod-btn ggl-btn"><img src="{{ asset('frontend/img/google.png') }}"
                            alt="">
                        Sign In with Google
                    </a>
                    <p class="reg-link">Alredy have an account? <a href="" data-toggle="modal"
                            data-target="#smallModal">
                            Login
                        </a>
                    </p>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Reset Password -->
<div class="modal fade" id="resetpass">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span id="fg" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Enter your registered email address to get the security code to reset the password</p>
                <form method="POST" id="resetpassform">
                    @csrf
                    <input type="text" name="email" placeholder="Email">
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {

        $(".modal").on("shown.bs.modal", function() {
            if ($(".modal-backdrop").length > 1) {
                $(".modal-backdrop").not(':first').remove();
            }
            jQuery(".reg-link a").click(function() {
                jQuery(".modal").removeClass("show");
                $(".modal-backdrop").remove();
                $("#smallModal").modal('hide');
            });

            jQuery(".forgot-pass").click(function() {
                jQuery(".modal").removeClass("show");
                $(".modal-backdrop").remove();
                $("#smallModal").modal('hide');
            });
        })

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

        $('body').on('submit', '#loginFrm', function(e) {
            e.preventDefault();

            var form = $("#loginFrm");

            var logEmail = $('.logEmail').val();
            var logPass = $('.logPass').val();

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
                        url: "{{ route('login_check') }}",
                        type: "POST",
                        data: form.serialize(),
                        dataType: "json",
                        success: function(resp) {
                            console.log(resp);
                            if (resp.errors) {
                                $("#smallModal").hide();
                                $(".modal-backdrop").remove();
                                notification(resp.errors, "error");
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                console.log(resp);
                                window.location.href = "{{ route('home') }}";
                                notification(resp.success, "success");
                            }
                        }
                    });
                }
            }
        });

        $('body').on('submit', '#registerForm', function(e) {
            e.preventDefault();

            var name = $('#username').val();
            var email = $('#email').val();
            var pass = $('#password').val();
            var cpass = $('#confirm_password').val();

            if (name.trim() == "") {

                $('#nameErr').text('Name cannot be blank')
                    .addClass('text-danger').removeClass('text-success');

            } else {

                $('#nameErr').text('Name is good')
                    .addClass('text-success').removeClass('text-danger');

                if (email.trim() == "") {

                    $('#emailErr').text('Email address cannot be blank')
                        .addClass('text-danger').removeClass('text-success');

                } else {

                    var re =
                        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                    if (re.test(email) == false) {

                        $('#emailErr').text("bad format")
                            .addClass('text-danger').removeClass('text-success');

                    } else {

                        $('#emailErr').text("Good format")
                            .addClass('text-success').removeClass('text-danger');

                        // passowrd validation start if else
                        if (pass.trim() == "") {

                            $('#passErr').text("Password cannot be blank")
                                .addClass('text-danger').removeClass('text-success');

                        } else {

                            const re = new RegExp(
                                "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

                            if (re.test(pass) == false) {

                                $('#passErr').text(
                                        "Password must be contain special character, alphabetic character and numeric character"
                                    )
                                    .addClass('text-danger').removeClass('text-success');

                            } else {

                                $('#passErr').text("Password looking good")
                                    .addClass('text-success').removeClass('text-danger');

                                if (cpass.trim() === "") {

                                    $('#cpassErr').text('Please enter confirm password')
                                        .addClass('text-danger').removeClass('text-success');

                                } else {

                                    if (pass != cpass) {

                                        $('#cpassErr').text(
                                                'Password and confirm password is not matching')
                                            .addClass('text-danger').removeClass('text-success');

                                    } else {

                                        $('#cpassErr').text('Password and confirm password is matched')
                                            .addClass('text-success').removeClass('text-danger');

                                        if (name !== "" && email !== "" && pass !== "" && cpass !==
                                            "" && pass === cpass) {

                                            var form = $("#registerForm");
                                            $.ajax({
                                                url: "{{ route('register') }}",
                                                type: "POST",
                                                data: form.serialize(),
                                                dataType: "json",
                                                success: function(resp) {
                                                    console.log("error");
                                                    if (resp.errors) {
                                                        if (resp.errors.name !== "") {
                                                            $("#nameErr").text(resp.errors
                                                                .name);
                                                        }
                                                        if (resp.errors.email !== "") {
                                                            $("#emailErr").text(resp.errors
                                                                .email).addClass(
                                                                'text-danger');
                                                        }
                                                        if (resp.errors.password !== "") {
                                                            $("#passErr").text(resp.errors
                                                                .password);
                                                        }
                                                        if (resp.errors
                                                            .password_confirmation !== "") {
                                                            $("#cpassErr").text(resp.errors
                                                                .password_confirmation);
                                                        }
                                                    } else {
                                                        console.log("success");
                                                        window.location.href =
                                                            "{{ route('price_plan') }}";
                                                        $("#smallModal2").hide();
                                                        $(".modal-backdrop").remove();
                                                        notification(resp.success,
                                                            "success");
                                                    }
                                                }
                                            });
                                        } else {
                                            console.log("Something wrong");
                                            $("#regBtn").attr("disabled", true).css({
                                                background: 'red',
                                                color: 'black',
                                                'font-size': '13px'
                                            }).val('Plase Don’t try to hack......... :)');
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });

        $('body').on('submit', '#resetpassform', function(e) {
            e.preventDefault();

            var form = $("#resetpassform");

            $.ajax({
                url: "{{ route('send_reset_password_email') }}",
                type: "POST",
                data: form.serialize(),
                dataType: "json",
                success: function(resp) {
                    console.log(resp);

                    var msg = resp.msg;
                    var status = resp.status;

                    notification(msg, status);

                    $("#resetpass").modal('hide');
                }
            });
        }); 
        
    });
</script>




