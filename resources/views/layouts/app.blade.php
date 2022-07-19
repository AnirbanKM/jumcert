<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.inc.header')
    @yield('frontendCss')
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.85);
            -webkit-backdrop-filter: saturate(180%) blur(10px);
            backdrop-filter: saturate(180%) blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99999999999;
        }

        .preloader img {
            animation: App_logo_spin infinite 2s linear;
        }

        @keyframes App_logo_spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <div class="preloader" id="canvas">
        <img src="{{ asset('jumcert.svg') }}" class="w-25">
    </div>

    @include('frontend.inc.menu')

    <main>
        @yield('content')
    </main>

    @include('frontend.inc.footer')

    @if (Session::has('success'))
        <script>
            new Noty({
                theme: 'sunset',
                type: 'success',
                layout: 'topRight',
                text: "{{ session::get('success') }}",
                timeout: 5000,
                closeWith: ['click', 'button']
            }).show();
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            new Noty({
                theme: 'sunset',
                type: 'error',
                layout: 'topRight',
                text: "{{ session::get('error') }}",
                timeout: 5000,
                closeWith: ['click', 'button']
            }).show();
        </script>
    @endif

    @include('frontend.modal.modal')

    @yield('GoLiveModal')
    @yield('frontendJs')

    @include('frontend.pages.global.chat')
    @include('frontend.pages.global.chatscript')

    @auth
        @if (Auth::user()->user_role == 1 || Auth::user()->user_role == 2)
            @if (Auth::user()->userAccount == null)
                <div class="user-account-alert-modal show" data-signup-modal>
                    <img src="https://jumcart.previewforclient.com/frontend/img/t-alert-con.svg" alt="" />
                    <h5>
                        <a href="{{ route('user_account') }}">
                            You need to create your bank account.
                        </a>
                    </h5>
                    <span class="close2" data-close></span>
                </div>
                <script>
                    const signupModal = document.querySelector('[data-signup-modal]');
                    const closeSignupModal = document.querySelector('[data-close]');
                    closeSignupModal.addEventListener('click', function(e) {
                        signupModal.classList.toggle('show');
                    });

                    setInterval(() => {
                        const signupModal = document.querySelector('.user-account-alert-modal');
                        signupModal.classList.add("show");
                    }, 600000);
                </script>
            @endif
        @endif
    @endauth

</body>

</html>
