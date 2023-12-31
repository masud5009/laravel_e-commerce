@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/admin/css/my.css') }}">
@endpush
@section('content')
    <div class="container flex-grow-1 container-p-y">
        <h5 class="text-dark">Edit product</h5>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="form form-horizontal mar-top">
            @csrf
            @method('PUT')
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
                                <input value="{{ $product->name }}" type="input" class="form-control" id="name"
                                    name="name" placeholder="Product Name">
                            </div>
                            <div class="form-group mb-2">
                                <label for="brand" class="form-label">Brand</label>
                                <div class="input-group">
                                    <label class="input-group-text">Brand</label>
                                    <select class="form-select" id="brand" name="brand">
                                        <option selected>Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ $product->brand == $brand->id ? 'checked' : '' }}>{{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input value="{{ $product->unit }}" type="input" class="form-control" id="unit"
                                    name="unit" placeholder="Unit (e.g KG, Pc etc)">
                            </div>
                            <div class="form-group mb-3">
                                <label for="weight" class="form-label">Weight(In Kg)</label>
                                <input value="{{ $product->weight }}" type="input" class="form-control" name="weight"
                                    min="0" step="0.01">
                            </div>
                            <div class="form-group mb-3">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input value="{{ $product->barcode }}" type="input" class="form-control" name="barcode"
                                    placeholder="Barcode">
                            </div>
                            <div class="form-group">
                                <label for="tags" class="form-label">Tags</label>
                                <div class="tags-input">
                                    <ul id="tags"></ul>
                                    <input type="text" class="form-control" id="input-tag"
                                        placeholder="Type and hit enter to add a tag" />
                                    <input type="hidden" name="tags[]" id="tags-input" />

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
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                                <div class="form-text">
                                    These images are visible in product details page gallery. Use 600x600 sizes images.
                                </div>
                                @php
                                    $image = $product->images;
                                    $images = json_decode($image);
                                @endphp
                                <div class="d-flex">
                                    @foreach ($images as $image)
                                        <img src="{{ asset($image) }}" alt="{{ $product->name }}"
                                            style="max-width: 100px;padding:10px">
                                    @endforeach
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
                                <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}"
                                    style="max-width: 100px;padding:10px">
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
                                    <input value="{{ $product->unit_price }}" type="text" name="unit_price"
                                        class="form-control" placeholder="100"
                                        aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Discount Date Range</label>
                                <input value="{{ $product->discunt_date }}" class="form-control" type="datetime-local"
                                    id="discunt_date" name="discount_date">
                            </div>
                            <div class="form-group mb-2">
                                <label for="unit_price" class="form-label">Discount<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input value="{{ $product->discount_price }}" name="discount_price" type="number"
                                        min="0" step="0.01" class="form-control no-spin" placeholder="100"
                                        aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input value="{{ $product->sku }}" type="input" class="form-control" name="sku"
                                    placeholder="SKU">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Quantity<span class="text-danger fs-6">*</span></label>
                                <input class="form-control no-spin" min="0" type="number" id="quantity"
                                    name="quantity" value="{{ $product->quantity }}">
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
                                        <option value="">color name</option>
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
                                <textarea name="description" id="description" cols="30" rows="10">{!! $product->description !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Product category -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title p-0">Product category</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="category" class="form-label">Select Category<span class="text-danger fs-6">
                                        *</span></label>
                                <select class="form-select" id="category" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="subcategory" class="form-label">Select Sub-category</label>
                                <select class="form-select" id="subcategory" name="subcategory_id">
                                    <option selected disabled>Select Subcategory</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="category" class="form-label">Select Child-category</label>
                                <select class="form-select" id="childcategory" name="childcategory_id">
                                    <option selected disabled>Select Childcategory</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Configuration -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Shipping Configuration</h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span>Free Shipping</span>
                                <label class="switch">
                                    <input type="checkbox" id="free_shipping_status" name="free_shipping_status">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span>Flat Rate</span>
                                <label class="switch">
                                    <input type="checkbox" id="flat_rate_status">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group" id="flatRateInput" style="display: none;">
                                <label for="flat_rate" class="form-label">Flat Rate</label>
                                <input type="number" min="0" step="0.01" class="form-control no-spin"
                                    id="flat_rate" name="flat_rate">
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
                                    <input type="checkbox" id="cash_on_delivery_status" name="cash_on_delivery_status">
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
                                    name="warning_quantity" value="{{ $product->warning_quantity }}">
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
                                    <input type="checkbox" id="show_stock_quantity" name="show_stock_quantity">
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
                                    <input value="{{ $product->hide_stock }}" type="checkbox" id="hide_stock"
                                        name="hide_stock">
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
                                    <input value="{{ $product->featured }}" type="checkbox" id="featured"
                                        name="featured">
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
                                    <input value="{{ $product->todays_deal }}" type="checkbox" id="todays_deal"
                                        name="todays_deal">
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
                                <label for="" class="form-label">Shipping Days<span
                                    class="text-danger fs-6">*</span></label>
                                <input type="number" min="1" class="form-control no-spin" id="shipping_day"
                                    name="shipping_day" value="{{ $product->shipping_day }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-end">Update & Published</button>
        </form>
    </div>
@endsection
@push('scripts')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    {{-- DataTables --}}
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>

    {{-- Stock Visibility State  --}}
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
                    showStockQuantity.val(1);
                    showStockText.val(0);
                    hideStock.val(0);
                    hideStock.prop("checked", false);
                }
            });
            // Add an event listener to the "Show Stock Text" checkbox
            showStockText.on("change", function() {
                if ($(this).prop('checked')) {
                    showStockQuantity.prop("checked", false);
                    showStockQuantity.val(0);
                    showStockText.val(1);
                    hideStock.val(0);
                    hideStock.prop("checked", false);
                }
            });

            // Add an event listener to the "Hide Stock" checkbox
            hideStock.on("change", function() {
                if ($(this).prop('checked')) {
                    showStockQuantity.prop("checked", false);
                    showStockQuantity.val(0);
                    showStockText.val(0);
                    hideStock.val(1);
                    showStockText.prop("checked", false);
                }
            });
        });
    </script>

    {{-- Shipping Configuration --}}
    <script>
        $(document).ready(function() {
            const freeShippingCheckbox = $('#free_shipping_status');
            const flatRateCheckbox = $('#flat_rate_status');
            const flatRateInput = $('#flatRateInput');
            // shipping configuration checked & unchecked form database
            checkedStatus();
            // Add an event listener to the "Flat Rate" checkbox
            flatRateCheckbox.on('change', function() {
                if ($(this).prop('checked')) {
                    freeShippingCheckbox.prop("checked", false);
                    freeShippingCheckbox.val(1);
                    flatRateInput.show();
                } else {
                    flatRateInput.hide();
                }
            });

            // Add an event listener to the "Free Shipping" checkbox
            freeShippingCheckbox.on("change", function() {
                if ($(this).prop("checked")) {
                    flatRateCheckbox.prop("checked", false);
                    freeShippingCheckbox.val(1);
                    flatRateInput.hide();
                }
            });

            function checkedStatus() {
                let freeshippingStatus = {{ $product->free_shipping_status }};
                if (freeshippingStatus == 1) {
                    freeShippingCheckbox.prop('checked', true);
                    flatRateCheckbox.prop('checked', false);
                    flatRateInput.hide();
                } else {
                    flatRateCheckbox.prop('checked', true);
                    freeShippingCheckbox.prop('checked', false);
                    flatRateInput.show();
                }
            }
        });
    </script>

    {{-- Cash On Delivery --}}
    <script>
        $(document).ready(function() {
            let cash_on_delivery_status = $('#cash_on_delivery_status');

            //if cash on delivery status 1 then selected
            let productCashOnDeliveryStatus = {{ $product->cash_on_delivery_status }};
            cash_on_delivery_status.prop('checked', productCashOnDeliveryStatus == 1);

            cash_on_delivery_status.on('change', function() {
                if ($(this).prop('checked')) {
                    cash_on_delivery_status.val(1);
                }
            });
        });
    </script>

    {{-- Featured --}}
    <script>
        $(document).ready(function() {
            let featured = $('#featured');

            //if Featured status 1 then selected
            let featuredStatus = {{ $product->featured }};
            featured.prop('checked', featuredStatus == 1);

            featured.on('change', function() {
                if ($(this).prop('checked')) {
                    featured.val(1);
                }
            });
        });
    </script>

    {{-- Todays Deal --}}
    <script>
        $(document).ready(function() {
            let todays_deal = $('#todays_deal');

            //if Todays Deal status 1 then selected
            let todaysDealStatus = {{ $product->todays_deal }};
            todays_deal.prop('checked', todaysDealStatus);

            todays_deal.on('change', function() {
                if ($(this).prop('checked')) {
                    todays_deal.val(1);
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
    <script>
        $(document).ready(function() {
            $('#category').change(function() {
                var categoryId = $(this).val();
                updateSubcategories(categoryId);
            });

            $('#subcategory').change(function() {
                var subcategoryId = $(this).val();
                updateChildcategories(subcategoryId);
            });
        });

        function updateSubcategories(categoryId) {
            $.ajax({
                url: '{{ route('selected.subcategory', ['id' => '__id__']) }}'.replace(
                    '__id__', categoryId),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#subcategory').html(
                        '<option value="">Select Subcategory</option>'); // Clear subcategory options
                    $('#childcategory').html(
                        '<option value="">Select Childcategory</option>'); // Clear childcategory options
                    $.each(data, function(index, subcategory) {
                        $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory
                            .name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateChildcategories(subcategoryId) {
            $.ajax({
                url: '{{ route('selected.childcategory', ['id' => '__id__']) }}'.replace(
                    '__id__', subcategoryId),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#childcategory').html(
                        '<option value="">Select Childcategory</option>'); // Clear childcategory options
                    $.each(data, function(index, childcategory) {
                        $('#childcategory').append('<option value="' + childcategory.id + '">' +
                            childcategory.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    {{-- tags  --}}
    <script>
        $(document).ready(function() {
            const $tagsList = $('#tags');
            const $input = $('#input-tag');
            const $tagsInput = $('#tags-input');

            function updateTagsInput() {
                const tags = $tagsList.find('li').map(function() {
                    return $(this).text().trim();
                }).get();
                $tagsInput.val(JSON.stringify(tags));
            }

            $input.on('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();

                    const tagContent = $input.val().trim();

                    if (tagContent !== '') {
                        // Check if the tag already exists
                        if (!$tagsList.find('li:contains("' + tagContent + '")').length) {
                            const $tag = $('<li></li>');
                            $tag.text(tagContent);
                            $tag.append('<button class="delete-button">X</button>');
                            $tagsList.append($tag);
                            $input.val('');
                            updateTagsInput(); // Update the hidden input
                        } else {
                            // Tag already exists, clear the input
                            $input.val('');
                        }
                    }
                }
            });

            $tagsList.on('click', '.delete-button', function() {
                $(this).parent().remove();
                updateTagsInput(); // Update the hidden input
            });
        });
    </script>
@endpush
