@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <!-- Category Information -->
            <div class="card">
                <div class="card-header p-0" style="border-bottom: 1px solid #d9dee3">
                    <h5 class="mt-3 px-3">Category Information</h5>
                </div>
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="py-3">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Select Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="parent_id">
                                <option selected disabled>No Parent</option>
                                @foreach ($categories as $category)
                                    <option class="text-danger" value="{{ $category->id }}">---{{ $category->name }}</option>
                                    @if ($category->subcategory->count() > 0)
                                        @foreach ($category->subcategory as $subcategory)
                                            <option class="text-primary" value="{{ $subcategory->id }}">-----{{ $subcategory->name }}
                                            </option>
                                            @if ($subcategory->childcategory->count() > 0)
                                                @foreach ($subcategory->childcategory as $childcategory)
                                                    <option class="text-success" value="{{ $childcategory->id }}">-------{{ $childcategory->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="banner" class="form-label">Banner (200x200)</label>
                            <input type="file" class="form-control @error('banner') is-invalid @enderror"
                                name="banner">
                            @error('banner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="icon" class="form-label">Icon (32x32)</label>
                            <input type="file" class="form-control @error('icon') is-invalid @enderror"
                                name="icon">
                            @error('icon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="cover_img" class="form-label">Cover Image (250x250)</label>
                            <input type="file" class="form-control @error('cover_img') is-invalid @enderror"
                                name="cover_img">
                            @error('cover_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
