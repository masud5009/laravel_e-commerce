@push('css')
    <link rel="stylesheet" href="{{ asset('asset/admin/css/my.css') }}">
@endpush
@extends('admin.layouts.app')
@section('content')
    <div class="container flex-grow-1 container-p-y">
        <h5 class="text-dark">Add New product</h5>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
            class="form form-horizontal mar-top">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Product Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Product Information</h5>
                            <hr>
                        </div>
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Product Name <span
                                        class="text-danger fs-6">*</span></label>
                                <input type="input" class="form-control" id="name" name="name"
                                    placeholder="Product Name">
                            </div>
                            <div class="form-group mb-2">
                                <label for="category" class="form-label">Select Category<span class="text-danger fs-6">
                                        *</span></label>
                                <div class="input-group">
                                    <label class="input-group-text">Category</label>
                                    <select class="form-select" id="category" name="category">
                                        <option selected>Select Category</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="brand" class="form-label">Brand</label>
                                <div class="input-group">
                                    <label class="input-group-text">Brand</label>
                                    <select class="form-select" id="brand" name="brand">
                                        <option selected>Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="input" class="form-control" id="unit" name="unit"
                                    placeholder="Unit (e.g KG, Pc etc)">
                            </div>
                            <div class="form-group mb-3">
                                <label for="unit" class="form-label">Tags <span
                                        class="text-danger fs-6">*</span></label>
                                <div class="form-group mb-3 position-relative">
                                    <input type="text" class="form-control" id="product-tags"
                                        placeholder="Type and hit enter to add tag">
                                    <div class="tag-container">
                                        <!-- Tags will be displayed here -->
                                    </div>
                                    <div class="form-text text-danger" id="countdown">

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Product Images</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="images" class="form-label">Gallery Images (600x600)</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="images" name="images">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                                <div class="form-text">
                                    These images are visible in product details page gallery. Use 600x600 sizes images.
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail Image (300x300)</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                                    <label class="input-group-text">Upload</label>
                                </div>
                                <div class="form-text">
                                    This image is visible in all product box. Use 300x300 sizes image. Keep some blank
                                    space
                                    around main object of your image as we had to crop some edge in different devices to
                                    make it
                                    responsive.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product price + stock -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Product price + stock</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="unit_price" class="form-label">Unit price<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input type="text" value="0" class="form-control" placeholder="100"
                                        aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Discount Date Range</label>
                                <input class="form-control" type="datetime-local" id="discunt_date" name="discunt_date">
                            </div>
                            <div class="form-group mb-2">
                                <label for="unit_price" class="form-label">Discount price<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input type="number" value="0" min="0" step="0.01"
                                        class="form-control no-spin" placeholder="100"
                                        aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Quantity<span class="text-danger fs-6">*</span></label>
                                <input class="form-control no-spin" min="0" type="number" id="quantity"
                                    name="quantity">
                            </div>
                        </div>
                    </div>

                    <!-- Product Variation -->
                    <div class="card mb-4">
                        <div class="card-header ">
                            <div class="card-title">
                                <h5 class="card-title">Product Variation</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <div class="col-md-3">
                                    <input type="text" value="Colors" class="form-control" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select name="color" id="color" class="form-select" disabled>
                                        <option selected>Nothing selected</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->name }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" id="variation" name="variation">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-3">
                                    <input type="text" value="Attributes" class="form-control" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select name="attributes" id="attributes" class="form-select" disabled>
                                        <option selected>Nothing selected</option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->name }}"
                                                data-attribute-value="{{ $attribute->id }}">{{ $attribute->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3 attributeValueDiv" style="display: none">
                                <div class="col-md-3">
                                    <input type="text" value="Values" class="form-control" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select name="attribute_values" id="attribute_values" class="form-select">
                                        <!-- here are show the data under attribute -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Product Description</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Shipping Configuration -->
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Shipping Configuration</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span>Free Shipping</span>
                                <label class="switch">
                                    <input type="checkbox" id="free_shipping_status" name="free_shipping_status" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span>Flat Rate</span>
                                <label class="switch">
                                    <input type="checkbox" id="flat_rate_status" name="flat_rate_status">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group" id="flatRateInput" style="display: none;">
                                <label for="flat_rate" class="form-label">Flat Rate</label>
                                <input type="number" min="0" step="0.01" value="0"
                                    class="form-control no-spin" id="flat_rate" name="flat_rate">
                            </div>
                        </div>
                    </div>

                    <!-- Cash On Delivery -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Cash On Delivery</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Status</span>
                                <label class="switch">
                                    <input type="checkbox" id="cash_on_delivery_status" name="cash_on_delivery_status"
                                        checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Low Stock Quantity Warning -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Low Stock Quantity Warning</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="warningQuantity" class="form-label">Quantity </label>
                                <input type="number" min="0" class="form-control no-spin" id="warning_quantity"
                                    name="warning_quantity">
                            </div>
                        </div>
                    </div>
                    <!-- Stock Visibility State  -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Stock Visibility State </h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span>Show Stock Quantity</span>
                                <label class="switch">
                                    <input type="checkbox" id="show_stock_quantity" name="show_stock_quantity" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span>Show Stock With Text Only</span>
                                <label class="switch">
                                    <input type="checkbox" id="show_stock_text" name="show_stock_text">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span>Hide Stock</span>
                                <label class="switch">
                                    <input type="checkbox" id="hide_stock" name="hide_stock">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Featured -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Featured</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Status</span>
                                <label class="switch">
                                    <input type="checkbox" id="featured" name="featured">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- Todays Deal -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Todays Deal</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Status</span>
                                <label class="switch">
                                    <input type="checkbox" id="todays_deal" name="todays_deal">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Estimate Shipping Time -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Estimate Shipping Time</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="form-label">Shipping Days </label>
                                <input type="number" min="1" class="form-control no-spin" id="shipping_day"
                                    name="shipping_day">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-end">Save</button>
        </form>
    </div>
@endsection
@push('scripts')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get references to the checkboxes and the input field
            const showStockQuantity = $('#show_stock_quantity');
            const showStockText = $('#show_stock_text');
            const hideStock = $('#hide_stock');

            // Add an event listener to the "Show Stock Quantitiy" checkbox
            showStockQuantity.on("change", function() {
                if ($(this).prop('checked')) {
                    showStockText.prop("checked", false);
                    hideStock.prop("checked", false);
                }
            });
            // Add an event listener to the "Show Stock Text" checkbox
            showStockText.on("change", function() {
                if ($(this).prop('checked')) {
                    showStockQuantity.prop("checked", false);
                    hideStock.prop("checked", false);
                }
            });

            // Add an event listener to the "Hide Stock" checkbox
            hideStock.on("change", function() {
                if ($(this).prop('checked')) {
                    showStockQuantity.prop("checked", false);
                    showStockText.prop("checked", false);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get references to the checkboxes and the input field
            const freeShippingCheckbox = $('#free_shipping_status');
            const flatRateCheckbox = $('#flat_rate_status');
            const flatRateInput = $('#flatRateInput');

            // Add an event listener to the "Flat Rate" checkbox
            flatRateCheckbox.on('change', function() {
                if ($(this).prop('checked')) {
                    freeShippingCheckbox.prop("checked", false);
                    flatRateInput.show();
                } else {
                    flatRateInput.hide();
                }
            });

            // Add an event listener to the "Free Shipping" checkbox
            freeShippingCheckbox.on("change", function() {
                if ($(this).prop("checked")) {
                    flatRateCheckbox.prop("checked", false);
                    flatRateInput.hide();
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            const tagContainer = $('.tag-container');
            const tagInput = $('#product-tags');
            const addedTags = new Set();
            let maxTags = 8; // Maximum number of tags allowed

            // Function to update the countdown display
            function updateCountdown() {
                $('#countdown').text(maxTags + ' tags are remaining');
            }

            updateCountdown(); // Initial display of the countdown

            function addTag(tagValue) {
                if (maxTags > 0 && tagValue.length >= 2) {
                    const tagBadge = $('<span>').addClass('badge bg-primary tag-badge').text(tagValue);
                    const removeButton = $('<span>').addClass('badge tag-badge-remove').attr('id', 'crox-badge')
                        .text('x');

                    tagBadge.append(removeButton);
                    tagContainer.append(tagBadge);
                    addedTags.add(tagValue);
                    maxTags--;

                    updateCountdown(); // Update the countdown display

                    removeButton.click(function() {
                        tagBadge.remove();
                        addedTags.delete(tagValue);
                        maxTags++;

                        updateCountdown(); // Update the countdown display
                    });
                }
            }

            tagInput.keypress(function(event) {
                if (event.which === 13) { // Check if the Enter key (key code 13) is pressed
                    const tagValue = tagInput.val().trim();

                    if (tagValue !== '' && !addedTags.has(tagValue) && maxTags > 0) {
                        addTag(tagValue);
                        tagInput.val('');
                    } else {
                        tagInput.val('');
                    }
                }
            });
        });
    </script>

    <!-- product variation -->
    <script>
        $(document).ready(function() {
            let color = $('#color');
            let attributes = $('#attributes');
            let variation = $('#variation');

            variation.on('change', function() {
                if ($(this).prop('checked')) {
                    color.prop('disabled', false);
                    attributes.prop('disabled', false);

                    //attribute selected value show
                    $('#attributes').on('change', function() {
                        let selectedAttributeId = $(this).find('option:selected').data(
                            'attribute-value');
                        $('.attributeValueDiv').show();
                        $.ajax({
                            type: 'GET',
                            url: '{{ route('attribute.value', ['id' => '__id__']) }}'
                                .replace(
                                    '__id__', selectedAttributeId),
                            success: function(data) {
                                $('#attribute_values option:not(:first-child)')
                                    .remove();
                                for (let i = 0; i < data.length; i++) {
                                    $('#attribute_values').append('<option>' + data[i] +
                                        '</option>');
                                }
                            },
                            error: function() {
                                console.error('Error fetching attribute value.');
                            }
                        });

                    });

                } else {
                    color.prop('disabled', true);
                    attributes.prop('disabled', true);
                    $('.attributeValueDiv').hide();
                }
            });



        });
    </script>
@endpush
