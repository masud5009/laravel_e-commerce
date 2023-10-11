@extends('frontend.layouts.app')
@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('content')
    <!-- Cart Start -->
    <form action="{{ route('product.checkout') }}" method="get">
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-8 col-md-8 table-responsive mb-5">
                    <div class="card">
                        <div class="card-header bg-transparent">Product Information</div>
                        @if ($cart)
                            @foreach ($cart as $key => $product)
                                <div id="card-product" class="card-body p-0 py-3 px-3" data-product-id="{{ $key }}">
                                    <div class="row align-items-center">
                                        <div class="product-name-image d-lg-flex col-lg-6 col-md-4">
                                            <img src="{{ asset($product['image']) }}" alt="" style="width: 80px;">
                                            <p>{{ Str::limit($product['name'], 30) }}</p>
                                        </div>
                                        <div class="product-price col-lg-3 col-md-4">
                                            <div class="d-flex">
                                                <p class="text-danger">${{ $product['price'] }}</p>
                                                <del
                                                    class="text-muted px-2">${{ number_format($product['unit_price']) }}</del>
                                            </div>
                                            <p>-{{ $product['discount'] }}%</p>
                                            <a href="{{ route('remove.cart.item', $product['id']) }}"
                                                class="btn btn-sm btn-warning text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                        <div class="product-qunatiy col-lg-3 col-md-4">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-secondary btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input min="1" type="text" value="{{ $product['qty'] }}"
                                                    name="qty[{{ $product['id'] }}]"
                                                    class="form-control form-control-sm text-center qty">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-secondary btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <form class="mb-5" action="">
                        <div class="d-flex">
                            <input type="text" class="form-control col-lg-8" placeholder="Enter Voucher Code">
                            <button
                                class="btn btn-block btn-danger font-weight-semi-bold text-white col-lg-4">Apply</button>
                        </div>
                    </form>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-transparent border-0">
                            <h6 class="font-weight-semi-bold m-0">Order Summary</h6>
                        </div>
                        <div class="card-body border-0">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-light">Items Total</h6>
                                <h6 class="font-weight-light text-danger" id="subTotalPrice">$0</h6>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-light">Delivery Fee</h6>
                                <h6 class="font-weight-light text-danger" id="delivery_fee">$10</h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h6 class="font-weight-semi-bold">Total Payment</h6>
                                <h6 class="font-weight-semi-bold text-danger" id="payment_amount">$0</h6>
                            </div>
                            <button class="btn btn-block btn-warning font-weight-semi-bold text-white"
                                style="text-transform: uppercase">Proceed To Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Cart End -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#card-product").each(function() {
                var productId = $(this).data("product-id");
                calculateSubtotal();
            });

            function calculateSubtotal() {
                let subtotal = 0;
                $('.product-qunatiy').each(function() {
                    var quantity = parseInt($(this).find('.qty').val());
                    var price = parseFloat($(this).siblings('.product-price').find('p').text().replace('$',
                        ''));
                    var productSubtotal = quantity * price;
                    subtotal += productSubtotal;
                });
                $('#subTotalPrice').text('$' + subtotal);
                paymentAmount();
            }

            $('.btn-plus').on('click', function(e) {
                e.preventDefault();
                var quantity = $(this).closest(".quantity").find(".qty");
                var productId = $('#card-product').data('product-id');
                var value = parseInt(quantity.val());
                quantity.val(value + 1);
                // Update subtotal price
                calculateSubtotal();
                // Update quantity on cart page
                updateQuantiy(productId, value + 1)
            });

            $('.btn-minus').on('click', function(e) {
                e.preventDefault();
                var quantity = $(this).closest(".quantity").find(".qty");
                var productId = $('#card-product').data('product-id');
                var value = parseInt(quantity.val());
                if (value > 1) {
                    quantity.val(value - 1);
                    // Update subtotal price
                    calculateSubtotal();
                    // Update quantity on cart page
                    updateQuantiy(productId, value - 1)
                }

            });
            // Payment amount
            function paymentAmount() {
                let subtotalPrice = parseInt($('#subTotalPrice').text().replace('$', ''));
                let delivery_amount = parseInt($('#delivery_fee').text().replace('$', ''));
                let payment_amount = subtotalPrice + delivery_amount;
                $('#payment_amount').text('$' + payment_amount);
            }

            function updateQuantiy(productId, newQuantity) {
                console.log(productId);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '{{ route('update.quantity', ['id' => '__id__']) }}'.replace('__id__',
                        productId),
                    data: {
                        id: productId,
                        quantity: newQuantity
                    },
                    success: function(data) {
                        console.log('ok');
                    }
                });
            }
        });
    </script>
@endpush
