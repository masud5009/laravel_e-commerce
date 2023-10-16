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
    <div class="container-fluid position-relative">
        <div class="row top-bg py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2"
                        href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2"
                        href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2"
                        href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <!-- logo -->
            <div class="col-lg-3 col-md-3 col-sm-6 d-lg-block d-md-block d-sm-block d-block py-2">
                <a href="{{ route('website.home') }}" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
            </div>
            <!-- search option -->
            <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="productSearch" placeholder="Search for products">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <ul id="searchResults"
                            style="position: absolute; top: 100%; left: 0; width: 100%; background-color: white;z-index:999">
                        </ul>
                    </div>
                </form>
            </div>
            <!-- cart option -->
            <div class="col-lg-3 col-md-3 text-right d-none d-lg-block d-md-block">

                <a href="#" data-toggle="modal" data-target="#wishlist">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="{{ route('view.cart') }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">{{ count((array) session('cart')) }}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start-->
    @include('frontend.layouts.navbar')
    <!-- Navbar End-->



    @yield('content')


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
