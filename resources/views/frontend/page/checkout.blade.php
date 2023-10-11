@extends('frontend.layouts.app')
@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('content')
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <div class="card">
                    <div class="card-header bg-transparent">Order Information</div>
                    {{-- @php
                        $cart = (array) session('cart');
                    @endphp
                    @if ($cart) --}}
                    @if ($cart)
                        @foreach ($cart as $key => $product)
                            <div id="card-product" class="card-body p-0 py-3 px-3">

                                <div class="row align-items-center">
                                    <div class="product-name-image col-lg-6">
                                        <img src="{{ asset($product['image']) }}" alt="" style="width: 80px;">

                                        {{ Str::limit($product['name'], 30) }}

                                    </div>
                                    <div class="product-quantity col-lg-3">
                                        Quantity:<p>{{ $product['qty'] }}</p>
                                    </div>
                                    <div class="product_price col-lg-3 d-flex justify-content-between align-items-center">
                                        <p class="text-danger">${{ $product['price'] }}</p>
                                        <a href="{{ route('remove.cart.item', $product['id']) }}"
                                            class="btn btn-sm btn-warning text-white">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-transparent">
                        <h5 class="font-weight-medium m-0 d-flex justify-content-between align-items-center">Order
                            Summary
                            <span>({{ count((array) session('cart')) }})</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-light">Items Total</h6>
                            <h6 class="font-weight-light text-danger" id="subtotalPrice">$0</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-light">Delivery Fee</h6>
                            <h6 class="font-weight-light text-danger" id="delivery_fee">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <h6 class="font-weight-medium">Total Payment</h6>
                            <h6 class="font-weight-medium text-danger" id="payment_amount">$0</h6>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-semi-bold text-white mt-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
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
                $('.product_price').each(function() {
                    let quantity = parseInt($('.product-quantity').find('p').text());
                    let price = parseInt($(this).find('p').text().replace('$', ''));
                    var productSubtotal = quantity * price;
                    subtotal += productSubtotal;
                });

                let subtotalPrice = $('#subtotalPrice').text('$' + subtotal);
                paymentAmount();
            }
            // Payment amount
            function paymentAmount() {
                let subtotalPrice = parseInt($('#subtotalPrice').text().replace('$', ''));
                let delivery_amount = parseInt($('#delivery_fee').text().replace('$', ''));
                let payment_amount = subtotalPrice + delivery_amount;
                $('#payment_amount').text('$' + payment_amount);
            }


        });
    </script>
@endpush
