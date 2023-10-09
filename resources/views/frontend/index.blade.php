@extends('frontend.layouts.app')
@push('css')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('content')
    <!-- Product Quick View Modal -->
    <div class="modal fade md-effect" id="quickViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add to Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="quick_view_modal">

                </div>
            </div>
        </div>
    </div>

    <!-- Product Wishlist View Modal -->
    <div class="modal fade md-effect" id="wishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Wishlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="wishlist">

                </div>
            </div>
        </div>
    </div>

    @include('frontend.page.carosel.categories')

    <!-- Featured Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->

    <!-- Todays Deal End Start -->
    <div class="container-fluid mb-5">
        <h5 class="px-xl-5 py-3">Todays Deal</h5>
        <div class="row px-xl-5">
            {{-- <div class="col"> --}}
            <div class="owl-carousel related-carousel">
                @forelse ($todaysDealProducts as $todaysDealProduct)
                    @php
                        $unit_price = $todaysDealProduct->unit_price;
                        $discount_value = number_format($todaysDealProduct->discount_price);
                        $discountPrecente = $unit_price * ($discount_value / 100);
                        $price_real = $unit_price - $discountPrecente;
                        $price = round($price_real, 0, PHP_ROUND_HALF_DOWN);
                    @endphp
                    <div class="card product-item border-0 mb-5">
                        <div class="card-header bg-transparent border-0 p-0">
                            <div class="product-img position-relative overflow-hidden bg-transparent">
                                <a href="{{ route('product.details', $todaysDealProduct->slug) }}">
                                    <img style="height: 190px;width:100%" src="{{ $todaysDealProduct->thumbnail }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="px-2">
                                <a href="{{ route('product.details', $todaysDealProduct->slug) }}"
                                    class="text-decoration-none p-0">
                                    <p class="text-dark p-0" style="font-size: 15px">
                                        {{ Str::limit($todaysDealProduct->name, 40) }}
                                    </p>
                                </a>
                                <h6 class="text-danger">${{ $price }}<del
                                        class="text-muted px-1">${{ $todaysDealProduct->unit_price }}</del></h6>
                                <div class="discount-percentage">-{{ $discount_value }}%</div>

                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0  d-flex justify-content-center">
                            <button id="{{ $todaysDealProduct->id }}" class="quick_view btn btn-sm btn-info"
                                data-toggle="modal" data-target="#quickViewModal"><i class="fa fa-eye"></i> Quick
                                View</button>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            {{-- </div> --}}
        </div>
    </div>
    <!-- Todays Deal End -->

    <!-- Trandy Products Start -->
    <div class="container-fluid mb-5">
        <h5 class="px-xl-5 py-3">Trandy Products</h5>
        <div class="row px-xl-5 pb-3">
            @foreach ($trendyProducts as $trendyProduct)
                @php
                    $unit_price = $trendyProduct->unit_price;
                    $discount_value = number_format($trendyProduct->discount_price);
                    $discountPrecente = $unit_price * ($discount_value / 100);
                    $price_real = $unit_price - $discountPrecente;
                    $price = number_format(round($price_real, 0, PHP_ROUND_HALF_DOWN), 2);
                @endphp
                <div class="col-lg-2 p-0 col-md-3 col-sm-4 col-6 px-2 mb-5">
                    <div class="card product-item border-0">
                        <div class="card-header bg-transparent border-0 p-0">
                            <div class="product-img position-relative overflow-hidden bg-transparent">
                                <a href="{{ route('product.details', $trendyProduct->slug) }}">
                                    <img style="height: 190px;width:100%" src="{{ $trendyProduct->thumbnail }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="px-2">
                                <a href="{{ route('product.details', $trendyProduct->slug) }}"
                                    class="text-decoration-none p-0">
                                    <p class="text-dark p-0" style="font-size: 15px">
                                        {{ Str::limit($trendyProduct->name, 40) }}
                                    </p>
                                </a>
                                <h6 class="text-danger">${{ $price }}<del
                                        class="text-muted px-1">${{ $trendyProduct->unit_price }}</del></h6>
                                <div class="discount-percentage">-{{ $discount_value }}%</div>

                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0  d-flex justify-content-center">
                            <button id="{{ $trendyProduct->id }}" class="quick_view btn btn-sm btn-info"
                                data-toggle="modal" data-target="#quickViewModal"><i class="fa fa-eye"></i> Quick
                                View</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Trandy Products End -->

    <!-- Offer Start -->
    <div class="container-fluid offer">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <img src="img/offer-1.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <img src="img/offer-2.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    <!-- Categories Start -->
    <div class="container-fluid">
        <h5 class="px-xl-5 py-3">Categories</h5>
        <div class="row px-xl-5 pb-3">
            @forelse ($categoriesWithImage as $category)
                <div class="col-lg-2 col-md-2 col-sm-4 col-6 p-0 m-0" style="height: 250px">
                    <div class="card" style="height: 100%">
                        <div class="card-body overflow-hidden">
                            <a href="{{ route('category.product', $category->slug) }}"
                                class="cat-img position-relative overflow-hidden mb-3">
                                <img class="img-fluid" src="{{ asset($category->cover_img) }}" alt=""
                                    style="height: 80%;width:100%">
                                <h6 class="font-weight-semi-bold py-2 px-3">{{ $category->name }}</h6>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse ()
        </div>
    </div>
    <!-- Categories End -->

    <!-- Just For You Products Start -->
    <div class="container-fluid">
        <h5 class="px-xl-5 py-3">Just For You</h5>
        <div class="row px-xl-5 pb-3">
            @foreach ($justProducts as $justProduct)
                @php
                    $unit_price = $justProduct->unit_price;
                    $discount_value = number_format($justProduct->discount_price);
                    $discountPrecente = $unit_price * ($discount_value / 100);
                    $price_real = $unit_price - $discountPrecente;
                    $price = number_format(round($price_real, 0, PHP_ROUND_HALF_DOWN), 2);
                @endphp
                <div class="col-lg-2 p-0 col-md-3 col-sm-4 col-6 px-2 mb-5">
                    <div class="card product-item border-0">
                        <div class="card-header bg-transparent border-0 p-0">
                            <div class="product-img position-relative overflow-hidden bg-transparent border">
                                <a href="{{ route('product.details', $justProduct->slug) }}">
                                    <img style="height: 190px;width:100%" src="{{ $justProduct->thumbnail }}"
                                        alt="" style="max-heigh:100px">
                                </a>
                            </div>
                        </div>
                        <div class="card-body product-body border-0">
                            <div class="px-2">
                                <a href="{{ route('product.details', $justProduct->slug) }}"
                                    class="text-decoration-none p-0">
                                    <p class="text-dark p-0" style="font-size: 15px">
                                        {{ Str::limit($justProduct->name, 40) }}
                                    </p>
                                </a>
                                <h6 class="text-danger">${{ $price }}
                                    <del class="text-muted px-1">${{ $justProduct->unit_price }}</del>
                                </h6>
                                <div class="discount-percentage">-{{ $discount_value }}%</div>

                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0  d-flex justify-content-center">
                            <button id="{{ $justProduct->id }}" class="quick_view btn btn-sm btn-info"
                                data-toggle="modal" data-target="#quickViewModal"><i class="fa fa-eye"></i> Quick
                                View</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="d-flex justify-content-center align-items-center">
            {{ $trendyProducts->links() }}
        </div>
    </div>
    <!-- Just For You Products End -->

    <!-- Vendor Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-1.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-2.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-3.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-4.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-5.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-6.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-7.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
@endsection
@push('script')
    <script>
        $(document).on('click', '.quick_view', function() {
            var id = $(this).attr('id');
            $.ajax({
                type: 'get',
                url: '{{ route('cart.info', ['id' => '__id__']) }}'.replace(
                    '__id__', id),
                success: function(response) {
                    $('#quick_view_modal').html(response);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Show the modal with animation when it's opened
            $('#quickViewModal').on('show.bs.modal', function() {
                $(this).find('.modal-content').addClass('slip-from-top');
            });

            // Remove the animation class when the modal is closed
            $('#quickViewModal').on('hidden.bs.modal', function() {
                $(this).find('.modal-content').removeClass('slip-from-top');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#quickViewModal').on('show.bs.modal', function() {
                // Add animation class when the modal is shown
                $(this).find('.modal-content').addClass('md-effect');
            });

            $('#quickViewModal').on('hidden.bs.modal', function() {
                // Remove animation class when the modal is hidden
                $(this).find('.modal-content').removeClass('md-effect');
            });
        });
    </script>
@endpush
