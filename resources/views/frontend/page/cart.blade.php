@extends('frontend.layouts.app')
@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('frontend.page.navbar')

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>

                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $cart = (array) session('cart');
                        @endphp
                        @if ($cart)
                            @foreach ($cart as $key => $product)
                                <tr data-product-id="{{ $key }}">
                                    <td class="align-middle">
                                        {{-- <img src="{{ $product['image'] }}" alt="" style="width: 50px;"> --}}
                                        {{ $product['name'] }}
                                    </td>
                                    <td class="align-middle">${{ $product['price'] }}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input min="1" type="text" value="{{ $product['qty'] }}"
                                                name="qty"
                                                class="form-control form-control-sm bg-secondary text-center qty">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <!-- here tototal price for very qunatity product -->
                                        <span class="price"></span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-primary removeProduct">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"><a href="">Go to shop</a></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium" id="subTotalPrice"></h6>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            {{-- @if ($ProductFlatRate[0] === 1)
                            <h6 class="font-weight-medium">Free Shipping</h6>
                            @else
                            <h6 class="font-weight-medium" id="shipping_charge">{{$ProductFlatRate[0]}}</h6>
                            @endif --}}
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$160</h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            //TotalPrice for Every Quantity Product
            function updateTotalPrice(productId) {
                var productRow = $("tr[data-product-id='" + productId + "']");
                var quantity = parseInt(productRow.find(".qty").val());
                var pricePerItem = parseFloat(productRow.find(".align-middle:eq(1)").text().replace("$", ""));
                var ProductPricePerIncrement = quantity * pricePerItem;
                productRow.find(".price").text('$' + ProductPricePerIncrement.toFixed(2));

                //SubtotalPrice function
                updateSubtotal();

            }
            // update subTotalPrice for all product that add Table
            function updateSubtotal() {
                let productRow = $("tr[data-product-id]");
                let subtotal = 0;

                productRow.each(function() {
                    let productRow = $(this);
                    let quantity = parseInt(productRow.find(".qty").val());
                    let pricePerItem = parseFloat(productRow.find(".align-middle:eq(1)").text().replace("$",
                        ""));
                    let totalPrice = quantity * pricePerItem;
                    subtotal += totalPrice;
                });
                $("#subTotalPrice").text("$" + subtotal.toFixed(2));

            }
            // TotalPrice with shipping charge
            function TotalPriceWithCharge() {

            }


            $("tr[data-product-id").each(function() {
                var productId = $(this).data("product-id");
                updateTotalPrice(productId);
            });

            $('.btn-plus').on('click', function() {
                var quantity = $(this).closest(".quantity").find(".qty");
                var productId = $(this).closest("tr").data("product-id");
                var value = parseInt(quantity.val());
                quantity.val(value + 1);
                updateTotalPrice(productId);
            });

            $('.btn-minus').on('click', function() {
                var quantity = $(this).closest(".quantity").find(".qty");
                var productId = $(this).closest("tr").data("product-id");
                var value = parseInt(quantity.val());
                if (value > 1) {
                    quantity.val(value - 1);
                    updateTotalPrice(productId);
                }

            });
        });
    </script>
@endpush
