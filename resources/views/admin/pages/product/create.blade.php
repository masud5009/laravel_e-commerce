@push('css')
    <link rel="stylesheet" href="{{ asset('asset/admin/css/my.css') }}">
@endpush
@extends('admin.layouts.app')
@section('content')
    <div class="container flex-grow-1 container-p-y">
        <h5>Add New product</h5>
        <form action="" class="form form-horizontal mar-top">
             <!-- Product Information -->
            <div class="col-lg-8 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product Information</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="input" class="form-control" id="name" name="name"
                                placeholder="Product Name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="category" class="form-label">Select Category<span class="text-danger">
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
                                    @foreach ($brand as $br)
                                        <option value="{{ $br->name }}">{{ $br->name }}</option>
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
                            <label for="unit" class="form-label">Tags</label>
                            <div class="form-group mb-3 position-relative">
                                <input type="text" class="form-control" id="product-tags" placeholder="Add tags">
                                <div class="tag-container">
                                    <!-- Tags will be displayed here -->
                                </div>
                                <div class="form-text text-danger" id="countdown">

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Product Images -->
            <div class="col-lg-8 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product Images</h5>
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
                                This image is visible in all product box. Use 300x300 sizes image. Keep some blank space
                                around main object of your image as we had to crop some edge in different devices to make it
                                responsive.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product price + stock -->
            <div class="col-lg-8 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product price + stock</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Unit price<span class="text-danger">*</span></label>
                            <input type="input" class="form-control" id="name" name="name"
                                placeholder="Product Name">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Variation -->
            <div class="col-lg-8 mb-5">
                <div class="card">
                    <div class="card-header ">
                        <div class="card-title">
                            <h5 class="card-title">Product Variation</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <input type="text" value="Colors" class="form-control" disabled>
                            </div>
                            <div class="col-md-8">
                                <select name="color" id="color" class="form-select">
                                    <option selected>Nothing selected</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <input type="text" value="Attributes" class="form-control" disabled>
                            </div>
                            <div class="col-md-8">
                                <select name="attributes" id="attributes" class="form-select">
                                    <option selected>Nothing selected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description -->
            <div class="col-lg-8 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product Description</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
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
@endpush
