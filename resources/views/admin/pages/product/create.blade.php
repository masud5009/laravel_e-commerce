@extends('admin.layouts.app')
@section('content')
    <div class="container flex-grow-1 container-p-y">
        <h5>Add New product</h5>
        <form action="" class="form form-horizontal mar-top">
            <div class="col-lg-8 mb-5">
                <div class="card">
                    <h5 class="card-header">Product Information</h5>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="input" class="form-control" id="name" name="name" placeholder="Product Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                            <select class="form-control" id="category" name="category">
                                <option selected>Select Category</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand" class="form-label">Brand</label>
                            <select class="form-control" id="brand" name="brand">
                                <option selected>Select Category</option>
                                @foreach ($brand as $br)
                                <option value="{{ $br->name }}">{{ $br->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-5">
                <div class="card">
                    <h5 class="card-header">Product Images</h5>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="images" class="form-label">Gallery Images (600x600)</label>
                            <input type="file" class="form-control" id="images" name="images">
                            <div class="form-text">
                                These images are visible in product details page gallery. Use 600x600 sizes images.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Image (300x300)</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            <div class="form-text">
                                This image is visible in all product box. Use 300x300 sizes image. Keep some blank space
                                around main object of your image as we had to crop some edge in different devices to make it
                                responsive.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-5">
                <div class="card">
                    <h5 class="card-header">Product price + stock</h5>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Unit price<span class="text-danger">*</span></label>
                            <input type="input" class="form-control" id="name" name="name" placeholder="Product Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-5">
                <div class="card">
                    <h5 class="card-header">Product Description</h5>
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
@endpush
