@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <!-- Category Information -->
            <div class="card">
                <div class="card-header p-0" style="border-bottom: 1px solid #d9dee3">
                    <h5 class="mt-3 px-3">Header Setting </h5>
                </div>
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="py-3">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="banner" class="form-label">Header Logo</label>
                            <input type="file" class="form-control @error('banner') is-invalid @enderror" name="banner">
                            @error('banner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="banner" class="form-label">Header Logo</label>
                            <input type="file" class="form-control @error('banner') is-invalid @enderror" name="banner">
                            @error('banner')
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
