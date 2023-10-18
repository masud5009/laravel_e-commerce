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
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
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
