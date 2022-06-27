<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.inc.header')
</head>

<body>

    @include('frontend.inc.menu')

    <main>
        <section class="page_content about-section1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3">
                        @include('frontend.inc.sidebar')
                    </div>

                    <div class="col-lg-9">
                        @yield('content')
                    </div>

                </div>
            </div>
        </section>
    </main>

    @include('frontend.inc.footer')

    @if (Session::has('success'))
        <script>
            new Noty({
                theme: 'sunset',
                type: 'success',
                layout: 'topRight',
                text: "{{ session::get('success') }}",
                timeout: 3000,
                closeWith: ['click', 'button']
            }).show();
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            new Noty({
                theme: 'sunset',
                type: 'success',
                layout: 'topRight',
                text: "{{ session::get('error') }}",
                timeout: 3000,
                closeWith: ['click', 'button']
            }).show();
        </script>
    @endif

    @include('frontend.modal.modal')

    @yield('frontendJs')
</body>

</html>
