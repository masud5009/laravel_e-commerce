@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/admin/css/my.css') }}">
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <!--Bootstrap modal-->
    <!-- Button trigger modal -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mt-3">
            All Categories
        </h5>
        <a href="{{ route('category.create') }}" type="button" class="btn btn-primary">
            Add Category
        </a>
    </div>

    <!--/.Bootsttap modal-->
    <div class="col-lg-12" id="Table">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-lg-9">
                        <h5>Categories</h5>
                    </div>
                    <div class="col-lg-3">
                        <input type="search" name="search" id="search" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                    <span class="fs-6 text-dark">Name</span>
                    <span class="fs-6 text-dark me-4">Options</span>
                </div>
                <div id="data">
                    @foreach ($categories as $key => $category)
                        <div class="accordion border-bottom" id="categorySelector{{ $category->id }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header d-flex justify-content-between" id="heading">
                                    <div class="col-lg-10 d-flex justify-content-around align-items-center">
                                        <i class='bx bx-plus-circle text-danger fs-5'></i>
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            {{ $category->name }}
                                        </button>
                                    </div>
                                    <div class="col-lg-2 d-flex justify-content-end align-items-center">
                                        <a href="{{ route('category.edit',$category->id)}}" class="btn-sm btn btn-primary m-2"
                                            data-id="{{ $category->id }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn-sm btn btn-danger m-2 deletBtn"
                                            data-id="{{ $category->id }}">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading" data-bs-parent="#categorySelector{{ $category->id }}">
                                    <div class="accordion-body">
                                        <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                                            <span>#</span>
                                            <h5>{{ $key++ }}</h5>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                                            <span>Banner</span>
                                            <img src="{{ asset($category->banner) }}" alt=""
                                                style="max-width: 100px;max-height:100px">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                                            <span>Icon</span>
                                            <img src="{{ asset($category->icon) }}" alt=""
                                                style="max-width: 100px;max-height:100px">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                                            <span>Cover Image</span>
                                            <img src="{{ asset($category->cover_img) }}" alt=""
                                                style="max-width: 100px;max-height:100px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="pagination" class="d-flex justify-content-center align-items-center">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            //Delete category
            $('body').on('click', '.deletBtn', function() {
                let id = $(this).data('id');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this category!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Cancel",
                    confirmButtonText: "OK",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((willDelete) => {
                    if (willDelete.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ route('category.destroy', ['category' => '__category__']) }}'
                                .replace(
                                    '__category__', id),
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                $('#data').load(location.href + ' #data');
                                Swal.fire("Success", response.success, "success");
                            },
                            error: function(xhr, status, error) {
                                // Handle errors here, if necessary
                                Swal.fire("Error",
                                    "An error occurred while deleting the category.",
                                    "error");
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        Swal.fire("Cancelled", "Your data is safe!", "info");
                    }
                });
            });
        });
    </script>
@endpush
