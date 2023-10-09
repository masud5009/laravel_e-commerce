@extends('frontend.layouts.app')
@push('css')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('title')
@endsection
@section('content')
    <!-- Modal -->
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
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="ml-4">
                                <select class="form-control">
                                    <option selected disabled>Sort by</option>
                                    <option value="latest">Latest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @forelse ($categoryProduct as $product)
                        @php
                            $unit_price = $product->unit_price;
                            $discount_value = $product->discount_price;
                            $discountPrecente = $unit_price * ($discount_value / 100);
                            $price_real = $unit_price - $discountPrecente;
                            $price = number_format(round($price_real, 0, PHP_ROUND_HALF_DOWN), 2);
                        @endphp
                        <div class="col-lg-3 p-0 col-md-4 col-sm-4 col-6 px-2 mb-5">
                            <div class="card product-item border-0">
                                <div class="card-header bg-transparent border-0 p-0">
                                    <div class="product-img position-relative overflow-hidden bg-transparent">
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img style="height: 190px;width:100%" src="{{ asset($product->thumbnail) }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="px-2">
                                        <a href="{{ route('product.details', $product->slug) }}"
                                            class="text-decoration-none p-0">
                                            <p class="text-dark p-0" style="font-size: 15px">
                                                {{ Str::limit($product->name, 40) }}
                                            </p>
                                        </a>
                                        <h6 class="text-danger">${{ $price }}<del
                                                class="text-muted px-1">${{ $product->unit_price }}</del></h6>
                                        <div class="discount-percentage">-{{ $discount_value }}%</div>

                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0  d-flex justify-content-center">
                                    <button id="{{ $product->id }}" class="quick_view btn btn-sm btn-info"
                                        data-toggle="modal" data-target="#quickViewModal"><i class="fa fa-eye"></i> Quick
                                        View</button>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    {{ $categoryProduct->links() }}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
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
