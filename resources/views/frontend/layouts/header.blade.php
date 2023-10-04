<div class="container-fluid mb-5">
    <div class="row bg-warning" style="height: 64px">
        <!-- Category Section Start -->
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-transparent text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <!-- navbar -->
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    @foreach ($categories as $category)
                        <div class="nav-item dropdown px-2">
                            <a href="#" class="py-2 px-2 d-flex align-items-center text-dark"
                                data-toggle="dropdown">
                                <img src="{{ asset('storage/images/category_img/' . $category->icon) }}" alt=""
                                    class="img-fluid px-1" style="width: 30px">{{ $category->name }}
                                <i class="fa fa-angle-right float-right mt-1 px-1"></i>
                            </a>
                            @if ($category->subcategory->count() > 0)
                                @foreach ($category->subcategory as $subcategory)
                                    <div
                                        class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                        <a href="" class="dropdown-item">{{ $subcategory->name }}</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </nav>
            <!-- /.navbar -->
        </div>
        <!-- Category Section End -->
        <!-- Navbar Start-->
        @include('frontend.layouts.navbar')
        <!-- Navbar End-->
    </div>

    <div class="col-lg-9 col-sm-12" id="featured-product">
        <!-- Product Slider Start -->
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 410px;">
                    <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                                Order
                            </h4>
                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                            <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="height: 410px;">
                    <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                                Order
                            </h4>
                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                            <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
        <!-- Product Slider End -->

    </div>

</div>
