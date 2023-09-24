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
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                <tr rowId="{{ $id }}">
                                    <td class="align-middle">
                                        <img src="{{ $details['image'] }}" alt="" style="width: 50px;">
                                        {{ $details['name'] }}
                                    </td>
                                    @php
                                        $unit_price = $details['unit_price'];
                                        $discount_price = $details['discount_price'];

                                        $amount = $unit_price - $discount_price;
                                        $productPrice = ($amount / $unit_price) * 100;

                                    @endphp
                                    <td class="align-middle">${{ $productPrice }}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input min="1" type="text"
                                                class="form-control form-control-sm bg-secondary text-center"
                                                value="{{ $details['quantity'] }}"
                                                data-quantity="{{ $details['quantity'] }}" data-price="{{ $productPrice }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="price"></span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-primary removeProduct">
                                            <i class="fa fa-times"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"><a href="{{ route('product.shop') }}">Go to shop</a></td>
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
                            <h6 class="font-weight-medium" id="subTotalPrice">$</h6>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
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
        // Function to calculate and update total price
        function updateSubTotalPrice() {
            var subTotalPrice = 0;

            // Loop through each row in the cart table
            $('.table tbody tr').each(function() {
                var row = $(this);
                var price = parseFloat(row.find('.price').text().replace('$', ''));
                subTotalPrice += price;
            });

            // Update the Total Price element with the calculated value
            $('#subTotalPrice').text('$' + subTotalPrice.toFixed(2));
        }

        // Function to handle quantity changes
        function handleQuantityChange(input) {
            updateItemTotal(input);
            updateSubTotalPrice(); // Update the total price after quantity change
        }

        // Product Quantity
        $('.quantity button').on('click', function() {
            var button = $(this);
            var input = button.parent().parent().find('input');
            var oldValue = parseFloat(input.val());

            if (button.hasClass('btn-plus')) {
                var newVal = oldValue + 1;
            } else {
                if (oldValue > 1) {
                    var newVal = oldValue - 1;
                } else {
                    newVal = 1;
                }
            }

            input.val(newVal);
            input.data('quantity', newVal);

            // Call the function to handle quantity change
            handleQuantityChange(input);
        });

        // Price update increment or decrement quantity
        function updateItemTotal(input) {
            var quantity = parseFloat(input.data('quantity'));
            var price = parseFloat(input.data('price'));
            var total = quantity * price;
            input.data('total', total); // Update the data-total attribute
            input.closest('tr').find('.price').text('$' + total.toFixed(2));
        }

        $(document).ready(function() {
            $('.quantity input').each(function() {
                var input = $(this);
                updateItemTotal(input);
            });

            updateSubTotalPrice(); // Call it initially
        });
    </script>
@endpush
