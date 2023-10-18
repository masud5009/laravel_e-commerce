<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!--Toaster alert-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('public/asset/admin/css/my.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <style>
        #searchResults {
            width: 100%;
            background: #fff;
            /*! position: absolute; */
            box-shadow: 0px 4px 5px black;
            padding: 12px;
            list-style: none;
        }

        #searchResults {
            display: none;
        }
    </style>
    <link href="{{ asset('public/asset/frontend/css/style.css') }}" rel="stylesheet">
    @stack('css')

</head>

<body>
    <!-- Topbar Start -->
    @include('frontend.layouts.topbar')
    <!-- Topbar End -->

    <!-- Navbar Start-->
    @include('frontend.layouts.navbar')
    <!-- Navbar End-->

    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->

    <!-- Footer Start -->
    @include('frontend.layouts.footer')
    <!-- Footer End -->



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{-- <script src="lib/easing/easing.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="jquery.min.js"></script>
    <script src="owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('public/asset/frontend/js/main.js') }}"></script>
    <!-- Toaster alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Product display by search -->
    <script>
        $(document).ready(function() {
            $('#productSearch').on('input', function() {
                let product = $(this).val();

                $.ajax({
                    url: '{{ route('products.search') }}',
                    type: 'GET',
                    data: {
                        product: product
                    },
                    success: function(response) {
                        $('#searchResults').css('display', 'block');
                        $('#searchResults').html(response);
                    }
                });
            });

        });
    </script>
    <script>
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif
    </script>
    @stack('script')
</body>

</html>
