<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.inc.header')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('backend.inc.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('backend.menu.nav')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')
                    <!-- Page Content -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('backend.inc.copyRight')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('backend.scrollTop.scrollTop')

    <!-- Logout Modal-->
    @include('backend.modal.modal')

    @include('backend.inc.footer')

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

    @yield('adminjs')

</body>

</html>
