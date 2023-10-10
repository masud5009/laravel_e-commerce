@extends('frontend.layouts.app')
@push('css')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('content')

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table text-center mb-0">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th class="font-weight-light">Products</th>
                            <th class="font-weight-light">Price</th>
                            <th class="font-weight-light">Quantity</th>
                            <th class="font-weight-light">Total</th>
                            <th class="font-weight-light">Remove</th>
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
                                        <img src="{{ asset($product['image']) }}" alt="" style="width: 50px;">
                                        {{ Str::limit($product['name'], 40) }}
                                    </td>
                                    <td class="align-middle">${{ $product['price'] }}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-secondary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input min="1" type="text" value="{{ $product['qty'] }}"
                                                name="qty"
                                                class="form-control form-control-sm text-center qty">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-secondary btn-plus">
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
                                        <a href="{{ route('remove.cart.item', $product['id']) }}"
                                            class="btn btn-sm btn-danger removeProduct">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"><a href="{{ route('website.home') }}">Go to shop</a></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="d-flex">
                        <input type="text" class="form-control col-lg-8" placeholder="Enter Voucher Code">
                        <button class="btn btn-block btn-danger font-weight-semi-bold text-white col-lg-4">Apply</button>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="font-weight-semi-bold m-0">Cart Summary</h6>
                    </div>
                    <div class="card-body border-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-light">Subtotal</h6>
                            <h6 class="font-weight-light" id="subTotalPrice">$0</h6>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-light">Shipping</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h6 class="font-weight-semi-bold">Total</h6>
                            <h6 class="font-weight-semi-bold text-danger">$160</h6>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-semi-bold text-white"
                            style="text-transform: uppercase">Proceed To Checkout</button>
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
                productRow.find(".price").text('$' + ProductPricePerIncrement);

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
                $("#subTotalPrice").text("$" + subtotal);

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
