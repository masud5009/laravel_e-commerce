<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Icons. Uncomment required icon fonts -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('public/asset/admin') }}/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('public/asset/admin') }}/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('public/asset/admin') }}/css/demo.css" />
    <link rel="stylesheet" href="{{ asset('public/asset/admin') }}/css/my.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('public/asset/admin') }}/lib/perfect-scrollbar/perfect-scrollbar.css" />
 <!--Toaster alert-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('public/asset/admin') }}/lib/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    @stack('css')
    <!-- Helpers -->
    <script src="{{ asset('public/asset/admin') }}/js/helpers.js"></script>
    <script src="{{ asset('public/asset/admin') }}/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.includes.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.includes.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('public/asset/admin') }}/lib/jquery/jquery.js"></script>
    <script src="{{ asset('public/asset/admin') }}/lib/popper/popper.js"></script>
    <script src="{{ asset('public/asset/admin') }}/js/bootstrap.js"></script>
    <script src="{{ asset('public/asset/admin') }}/lib/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('public/asset/admin') }}/js/menu.js"></script>
    <!-- endbuild -->
    <!-- toaster cdn js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Vendors JS -->
    <script src="{{ asset('public/asset/admin') }}/lib/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('public/asset/admin') }}/js/main.js"></script>
    <!-- Toaster alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Page JS -->
    {{-- <script src="../assets/js/dashboards-analytics.js"></script> --}}
    @stack('scripts')
    <script>
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
        @if(Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @endif
    </script>
</body>

</html>
