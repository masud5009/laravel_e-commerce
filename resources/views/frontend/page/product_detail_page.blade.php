@extends('frontend.layouts.app')
@section('title')
    {{ $product->name }}
@endsection
@push('css')
    <style>
        #rating_pointer i {
            cursor: pointer;
            font-size: 20px;
        }

        .checked {
            color: #ffc107 !important;
        }
    </style>
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- Product Details -->
    <form action="{{ route('add.cart.item') }}" method="post" id="add-cart-form">
        @csrf
        @php
            $unit_price = $product->unit_price;
            $discount_value = number_format($product->discount_price);
            $discountPrecente = $unit_price * ($discount_value / 100);
            $price_real = $unit_price - $discountPrecente;
            $price = number_format(round($price_real, 0, PHP_ROUND_HALF_DOWN), 2);
        @endphp
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="hidden" name="name" value="{{ $product->name }}">
        <input type="hidden" name="price" value="{{ $price }}">
        <input type="file" name="image" value="{{ $product->thumbnail }}">
        <div class="container-fluid py-5">
            <div class="row px-xl-5">
                <div class="col-lg-5 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border">
                            @php
                                $image = $product->images;
                                $images = json_decode($image);
                            @endphp
                            @foreach ($images as $key => $image)
                                <div class="carousel-item {{ $key === 1 ? 'active' : '' }}">
                                    <img class="w-100 h-100" src="{{ asset($image) }}" alt="Image">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-7 pb-5">
                    <h3 class="font-weight-semi-bold" id="ProductName">{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        @php
                            $rating_5 = App\Models\Admin\Review::where('product_id', $product->id)
                                ->where('rating', 5)
                                ->count();
                            $rating_4 = App\Models\Admin\Review::where('product_id', $product->id)
                                ->where('rating', 4)
                                ->count();
                            $rating_3 = App\Models\Admin\Review::where('product_id', $product->id)
                                ->where('rating', 3)
                                ->count();
                            $rating_2 = App\Models\Admin\Review::where('product_id', $product->id)
                                ->where('rating', 2)
                                ->count();
                            $rating_1 = App\Models\Admin\Review::where('product_id', $product->id)
                                ->where('rating', 1)
                                ->count();

                            $sumRating = App\Models\Admin\Review::where('product_id', $product->id)->sum('rating');
                            $countRating = App\Models\Admin\Review::where('product_id', $product->id)->count('rating');
                        @endphp

                        @if ($countRating > 0)
                            @if (intval($sumRating / $countRating) == 5)
                                <div class="rating_color_set mr-2">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                </div>
                            @elseif (intval($sumRating / $countRating) >= 4 && intval($sumRating / 5) < $countRating)
                                <div class="rating_color_set mr-2">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star"></span>
                                </div>
                            @elseif (intval($sumRating / $countRating) >= 3 && intval($sumRating / 5) < $countRating)
                                <div class="rating_color_set mr-2">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                </div>
                            @elseif (intval($sumRating / $countRating) >= 2 && intval($sumRating / 5) < $countRating)
                                <div class="rating_color_set mr-2">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                </div>
                            @else
                                <div class="rating_color_set mr-2">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                </div>
                            @endif
                        @endif
                        @if (intval($sumRating / 5) > 0)
                            <small class="pt-1">({{ intval($sumRating / 5) }} Reviews)</small>
                        @else
                            <small class="pt-1">(No Reviews)</small>
                        @endif
                    </div>
                    <p>Estimate Shipping Time : <span class="text-dark">{{ $product->shipping_day }} Days</span></p>
                    <div class="row">
                        <div class="ml-3">
                            <a href="javascript:void();" class="text-primary fs-14 fw-600 d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                                    <g id="Group_25571" data-name="Group 25571" transform="translate(-975 -411)">
                                        <g id="Path_32843" data-name="Path 32843" transform="translate(975 411)"
                                            fill="#fff">
                                            <path
                                                d="M 16 31 C 11.9933500289917 31 8.226519584655762 29.43972969055176 5.393400192260742 26.60659980773926 C 2.560270071029663 23.77347946166992 1 20.00665092468262 1 16 C 1 11.9933500289917 2.560270071029663 8.226519584655762 5.393400192260742 5.393400192260742 C 8.226519584655762 2.560270071029663 11.9933500289917 1 16 1 C 20.00665092468262 1 23.77347946166992 2.560270071029663 26.60659980773926 5.393400192260742 C 29.43972969055176 8.226519584655762 31 11.9933500289917 31 16 C 31 20.00665092468262 29.43972969055176 23.77347946166992 26.60659980773926 26.60659980773926 C 23.77347946166992 29.43972969055176 20.00665092468262 31 16 31 Z"
                                                stroke="none"></path>
                                            <path
                                                d="M 16 2 C 12.26045989990234 2 8.744749069213867 3.456249237060547 6.100500106811523 6.100500106811523 C 3.456249237060547 8.744749069213867 2 12.26045989990234 2 16 C 2 19.73954010009766 3.456249237060547 23.2552490234375 6.100500106811523 25.89949989318848 C 8.744749069213867 28.54375076293945 12.26045989990234 30 16 30 C 19.73954010009766 30 23.2552490234375 28.54375076293945 25.89949989318848 25.89949989318848 C 28.54375076293945 23.2552490234375 30 19.73954010009766 30 16 C 30 12.26045989990234 28.54375076293945 8.744749069213867 25.89949989318848 6.100500106811523 C 23.2552490234375 3.456249237060547 19.73954010009766 2 16 2 M 16 0 C 24.8365592956543 0 32 7.163440704345703 32 16 C 32 24.8365592956543 24.8365592956543 32 16 32 C 7.163440704345703 32 0 24.8365592956543 0 16 C 0 7.163440704345703 7.163440704345703 0 16 0 Z"
                                                stroke="none" fill="#f3af3d"></path>
                                        </g>
                                        <path id="Path_32842" data-name="Path 32842"
                                            d="M28.738,30.935a1.185,1.185,0,0,1-1.185-1.185,3.964,3.964,0,0,1,.942-2.613c.089-.095.213-.207.361-.344.735-.658,2.252-2.032,2.252-3.555a2.228,2.228,0,0,0-2.37-2.37,2.228,2.228,0,0,0-2.37,2.37,1.185,1.185,0,1,1-2.37,0,4.592,4.592,0,0,1,4.74-4.74,4.592,4.592,0,0,1,4.74,4.74c0,2.577-2.044,4.432-3.028,5.333l-.284.255a1.89,1.89,0,0,0-.243.948A1.185,1.185,0,0,1,28.738,30.935Zm0,3.561a1.185,1.185,0,0,1-.835-2.026,1.226,1.226,0,0,1,1.671,0,1.061,1.061,0,0,1,.148.184,1.345,1.345,0,0,1,.113.2,1.41,1.41,0,0,1,.065.225,1.138,1.138,0,0,1,0,.462,1.338,1.338,0,0,1-.065.219,1.185,1.185,0,0,1-.113.207,1.06,1.06,0,0,1-.148.184A1.185,1.185,0,0,1,28.738,34.5Z"
                                            transform="translate(962.004 400.504)" fill="#f3af3d"></path>
                                    </g>
                                </svg>
                                <span class="ml-2 text-danger animate-underline-blue">Product Inquiry</span>
                            </a>
                        </div>
                        <div class="col mb-3">
                            <div class="d-flex">
                                <!-- Add to wishlist button -->
                                <a href="javascript:void(0)"
                                    class="mr-3 fs-14 text-dark opacity-60 has-transitiuon hov-opacity-100">
                                    <i class="fas fa-heart mr-1"></i>
                                    Add to wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($product->brand)
                        <div class="brand">
                            <p>Brand : {{ $product->brand }}</p>
                        </div>
                    @else
                        <div class="brand">
                            <p>Brand : Unknown</p>
                        </div>
                    @endif
                    <hr>
                    <!-- price -->
                    <div class="row mb-3 priceDiv">
                        <div class="col-sm-12 col-lg-2">
                            <div class="text-dark font-weight-medium mb-0">Price</div>
                        </div>
                        <div class="col-sm-12 col-lg-10">
                            <div class="d-flex align-items-center">
                                <!-- Discount Price -->
                                <strong id="discountPrice" class="fs-16 fw-700 text-danger">
                                    ${{ $price }}
                                </strong>
                                <span class="opacity-70" id="unit">/{{ $product->unit }}</span>
                                <br>
                                <!-- Unit -->
                                <del class="px-2">${{ $unit_price }}</del>
                                <span>-{{ $discount_value }}%</span>

                            </div>
                        </div>
                    </div>
                    <!-- size -->
                    @if ($product->attribute_values)
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <div class="text-dark font-weight-medium mb-0">
                                    Size
                                </div>
                            </div>
                            <div class="col-sm-10">
                            </div>
                        </div>
                    @else
                    @endif
                    <!-- Quantity -->
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <div class="text-dark font-weight-medium mb-0">
                                Quantity
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="d-flex align-items-center">
                                <div class="input-group quantity mr-3" style="width: 130px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-secondary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quantity"
                                        class="form-control form-control-sm text-dark text-center qty" min="1"
                                        value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-secondary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total Price -->
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <div class="text-dark font-weight-medium mb-0">
                                Total Price
                            </div>
                        </div>
                        <div class="col-sm-10 totalPrice">
                            <strong id="totalPrice" class="fs-16 fw-700 text-danger">
                                ${{ $price }}
                            </strong>
                        </div>
                    </div>
                    <!-- Add cart & buy now  -->
                    <div class="col-lg-5 p-0 mt-4">
                        <div class="d-flex justify-content-between">
                            @if ($product->quantity > 0)
                                <a href="" class="btn btn-warning rounded px-3 text-white"><i
                                        class="fas fa-shopping-bag"></i> Buy Now</a>
                                <button class="btn btn-danger rounded px-3 text-white" id="addProductOnCart"
                                    data-id="">
                                    <i class="fa fa-shopping-cart"></i> Add To
                                    Cart
                                </button>
                            @else
                                <a href="#" class="btn btn-warning rounded px-3 text-white disabled"><i
                                        class="fas fa-shopping-bag"></i> Stockout</a>
                                <button class="btn btn-danger rounded px-3 text-white" id="addProductOnCart"
                                    data-id="" disabled>
                                    <i class="fa fa-shopping-cart"></i> Add To
                                    Cart
                                </button>
                            @endif
                        </div>
                    </div>
    </form>
    <!-- Share Product-->
    <div class="d-flex mt-4">
        <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
        <div class="d-inline-flex">
            <a class="text-dark px-2" href="">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a class="text-dark px-2" href="">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="text-dark px-2" href="">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="text-dark px-2" href="">
                <i class="fab fa-pinterest"></i>
            </a>
        </div>
    </div>
    </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    <p>{!! $product->description !!}</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <!-- Reveiw Details Start-->
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="d-flex flex-column">
                                <div class="d-flex">
                                    <h4 class="mb-4" id="review_product_name">Total Review : </h4>

                                    <div class="all-rating-view ml-3">
                                        <div class="d-flex align-items-center">
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span> {{ $rating_5 }} reviews</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span> {{ $rating_4 }} reviews </span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span> {{ $rating_3 }} reviews </span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span> {{ $rating_2 }} reviews </span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span> {{ $rating_1 }} reviews </span>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($reviews as $review)
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                            style="width: 45px;">
                                        <div class="media-body">
                                            <h6>{{ $review->user->name }}<small> - <i>01
                                                        {{ $review->review_month }}
                                                        {{ $review->review_year }}</i></small></h6>
                                            <div class="text-warning mb-2">
                                                @if ($review->rating == 1)
                                                    <i class="fas fa-star"></i>
                                                @elseif ($review->rating == 2)
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                @elseif ($review->rating == 3)
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                @elseif ($review->rating == 4)
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                @elseif ($review->rating == 5)
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                @endif
                                            </div>
                                            <p>{!! $review->review !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Reveiw Details End-->

                        <!-- Review Form Start -->
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <h4 class="mb-4">Leave a review</h4>
                            <form action="{{ route('store.review') }}" method="post" id="review-form">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-warning star-rating" id="rating_pointer">
                                        <i class="far fa-star" data-rating="1"></i>
                                        <i class="far fa-star" data-rating="2"></i>
                                        <i class="far fa-star" data-rating="3"></i>
                                        <i class="far fa-star" data-rating="4"></i>
                                        <i class="far fa-star" data-rating="5"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="rating" id="rating-input" value="0">
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" name="review" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary px-3">Leave Your Review</button>
                                </div>
                            </form>
                        </div>
                        <!-- Review Form End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- Product Details End -->

    <!-- Related Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($randomProducts as $randomProduct)
                        @php
                            $unit_price = $randomProduct->unit_price;
                            $discount_value = number_format($randomProduct->discount_price);
                            $discountPrecente = $unit_price * ($discount_value / 100);
                            $price_real = $unit_price - $discountPrecente;
                            $price = round($price_real, 0, PHP_ROUND_HALF_DOWN);
                        @endphp

                        <div class="card product-item border-0">
                            <div
                                class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{ $randomProduct->thumbnail }}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $randomProduct->name }}</h6>
                                <div class="d-flex justify-content-center">

                                    <h6>${{ $price }}</h6>
                                    <h6 class="text-muted ml-2"><del>${{ $randomProduct->unit_price }}</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="javascript:void(0)" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-eye text-primary mr-1"></i>View
                                    Detail</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Related Products End -->
@endsection
@push('script')
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            function updatePrice() {
                var pricePerUnit = parseFloat($("#discountPrice").text().replace('$', ''));
                var quantity = parseInt($(".qty").val());
                var totalPrice = pricePerUnit * quantity;
                $("#totalPrice").text('$' + totalPrice.toFixed(2));
            }

            $('.btn-plus').on('click', function(e) {
                e.preventDefault();
                var quantity = $(this).closest(".quantity").find(".qty");
                var value = parseInt(quantity.val());
                quantity.val(value + 1);
                updatePrice();
            });

            $('.btn-minus').on('click', function(e) {
                e.preventDefault();
                var quantity = $(this).closest(".quantity").find(".qty");
                var value = parseInt(quantity.val());
                if (value > 1) {
                    quantity.val(value - 1);
                    updatePrice();
                }
            });

            // $('body').on('submit', '#add-cart-form', function(e) {
            //     e.preventDefault();
            //     var url = $(this).attr('action');
            //     var request = $(this).serialize();
            //     $.ajax({
            //         url: url,
            //         type: "post",
            //         data: request,
            //         success: function(response) {
            //              $('#add-cart-form')[0].reset();
            //             // if (response) {
            //             //     Swal.fire("Success", response.success, "success");
            //             // }
            //             //  $('#data').load(location.href + ' #data');
            //         }
            //     });
            // });
        });
    </script>
    <!-- Product Rating -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const starIcons = document.querySelectorAll(".star-rating i");
            const ratingInput = document.querySelector("#rating-input");

            starIcons.forEach((star) => {
                star.addEventListener("click", () => {
                    const rating = parseInt(star.getAttribute("data-rating"));
                    ratingInput.value = rating;
                    highlightStars(rating);
                });
            });

            function highlightStars(rating) {
                starIcons.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add("fas");
                        star.classList.remove("far");
                    } else {
                        star.classList.remove("fas");
                        star.classList.add("far");
                    }
                });
            }
        });
    </script>
@endpush
