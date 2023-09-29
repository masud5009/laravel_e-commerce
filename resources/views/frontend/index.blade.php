@extends('frontend.layouts.app')
@push('css')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('frontend.layouts.header')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    <!-- Featured Start -->
    <div class="container-fluid pt-5">
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

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            @forelse ($categoriesWithImage as $categorie)
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">15 Products</p>
                        <a href="" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ asset('storage/images/category_img/' . $categorie->icon) }}"
                                alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{ $categorie->name }}</h5>
                    </div>
                </div>
            @empty
            @endforelse ()
        </div>
    </div>
    <!-- Categories End -->

    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
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

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card product-item border mb-4">
                        <div class=" card-body text-center p-0">
                            <div class="product-img position-relative overflow-hidden bg-transparent border p-0">
                                <a href="{{ route('product.details', $product->slug) }}">
                                    <img class="img-fluid" src="{{ $product->thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="pt-4">
                                <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                </a>
                                <div class="d-flex justify-content-center">
                                    @php
                                        $unit_price = $product->unit_price;
                                        $discount_value = $product->discount_price;
                                        $discountPrecente = $unit_price * ($discount_value / 100);
                                        $price_real = $unit_price - $discountPrecente;
                                        $price = round($price_real, 0, PHP_ROUND_HALF_DOWN);
                                    @endphp
                                    <h6>${{ $price }}</h6>
                                    <h6 class="text-muted ml-2"><del>${{ $product->unit_price }}</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center bg-light">
                            <a href="#" id="{{ $product->id }}" class="btn btn-primary quick_view"
                                data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To
                                Cart
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
            <div class="m-auto">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo
                        labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
        </div>

        <div class="row px-xl-5 pb-3">
            @forelse ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card product-item border mb-4">
                        <div class=" card-body text-center p-0">
                            <div class="product-img position-relative overflow-hidden bg-transparent border p-0">
                                <a href="{{ route('product.details', $product->slug) }}">
                                    <img class="img-fluid" src="{{ $product->thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="pt-4">
                                <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                </a>
                                <div class="d-flex justify-content-center">
                                    @php
                                        $unit_price = $product->unit_price;
                                        $discount_value = $product->discount_price;
                                        $discountPrecente = $unit_price * ($discount_value / 100);
                                        $price_real = $unit_price - $discountPrecente;
                                        $price = round($price_real, 0, PHP_ROUND_HALF_DOWN);
                                    @endphp
                                    <h6>${{ $price }}</h6>
                                    <h6 class="text-muted ml-2"><del>${{ $product->unit_price }}</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="#" id="{{ $product->id }}" class="btn btn-primary quick_view"
                                data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To
                                Cart
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="d-flex justify-content-center align-items-center">
                {{ $products->links() }}
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            {{ $products->links() }}
        </div>
    </div>
    <!-- Products End -->

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
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
@endpush
