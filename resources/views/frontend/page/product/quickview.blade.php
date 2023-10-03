<form action="{{ route('add.cart.quickview') }}" method="post" id="add-cart-form">
    @csrf
    @php

        $unit_price = $product->unit_price;
        $discount_value = $product->discount_price;
        $discountPrecente = $unit_price * ($discount_value / 100);
        $price_real = $unit_price - $discountPrecente;
        $price = round($price_real, 0, PHP_ROUND_HALF_DOWN);
    @endphp
    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="name" value="{{ $product->name }}">
    <input type="hidden" name="price" value="{{ $price }}">
    <div class="container-fluid">
        <div class="row">
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
                <h5 class="font-weight-semi-bold">{{ $product->name }}</h5>
                <p>Estimate Shipping Time : <span class="text-dark">{{ $product->shipping_day }} Days</span></p>
                <div class="brand">

                    <p>Brand : @if ($product->brand)
                            {{ $product->brand }}
                        @else
                            Unknown
                        @endif
                    </p>
                </div>
                <hr>
                <!-- price -->
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <div class="text-dark font-weight-medium mb-0">Price</div>
                    </div>
                    <div class="col-sm-10">
                        <div class="d-flex align-items-center">
                            <!-- Discount Price -->
                            <strong id="discountPrice" class="fs-16 fw-700 text-danger">
                                ${{ $price }}
                            </strong>
                            <!-- Unit -->
                            <span class="opacity-70" id="unit">/{{ $product->unit }}</span>
                        </div>
                    </div>
                </div>
                <!-- size -->
                @if ($product->size)
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
                <div class="d-flex justify-content-between mb-3" style="width: 170px">
                    <div class="text-dark font-weight-medium mb-0">
                        Total Price
                    </div>
                    <div class="totalPrice">
                        <strong id="totalPrice" class="fs-16 fw-700 text-danger">
                            ${{ $price }}
                        </strong>
                    </div>
                </div>
                <!-- Add to cart -->
                <div class="col-lg-5 p-0 mt-4">
                    @if ($product->quantity > 1)
                        <button class="btn btn-danger rounded px-3 text-white" id="addProductOnCart" data-id="">
                            <i class="fa fa-shopping-cart"></i> Add To
                            Cart
                        </button>
                    @else
                        <button class="btn btn-danger rounded px-3 text-white" id="addProductOnCart" data-id=""
                            disabled>
                            <i class="fa fa-shopping-cart"></i> Add To
                            Cart
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</form>

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

        $('body').on('submit', '#add-cart-form', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: "post",
                data: request,
                success: function(response) {
                    $('#add-cart-form')[0].reset();
                    $('.modal').modal('hide');
                }
            });
        });
    });
</script>
