@extends('admin.layouts.app')
@push('css')
<link rel="stylesheet" href="{{asset('asset/admin/css/my.css')}}">
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal" id="add_category">
            Add Category
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <form id="ajaxform">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="category_id" id="category_id">
                        <div class="form-group mb-2">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name">
                            <span class="text-danger" id="name-error"></span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="banner" class="form-label">Banner (200x200)</label>
                            <input type="file" class="form-control" id="banner" name="banner">
                            <span class="text-danger" id="banner-error"></span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="icon" class="form-label">Icon (32x32)</label>
                            <input type="file" class="form-control" id="icon" name="icon">
                            <span class="text-danger" id="icon-error"></span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="cover_img" class="form-label">Cover Image (250x250)</label>
                            <input type="file" class="form-control" id="cover_img" name="cover_img">
                            <span class="text-danger" id="cover-error"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" cols="30" id="description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="saveBtn" class="btn btn-primary"></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $category->id }}" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            {{ $category->name }}
                                        </button>
                                    </div>
                                    <div class="col-lg-2 d-flex justify-content-end align-items-center">
                                        <a href="javascript:void(0)" class="btn-sm btn btn-primary m-2 editBtn"
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
                                            {{-- <img src="{{ asset('storage/images/category_img/' . $category->banner) }}"
                                                alt="" style="max-width: 100px;max-height:100px"> --}}
                                                <img src="{{$category->banner}}"
                                                alt="" style="max-width: 100px;max-height:100px">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                                            <span>Icon</span>
                                            {{-- <img src="{{ asset('storage/images/category_img/' . $category->icon) }}"
                                                alt="" style="max-width: 100px;max-height:100px"> --}}
                                                <img src="{{$category->icon}}"
                                                alt="" style="max-width: 100px;max-height:100px">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                                            <span>Cover Image</span>
                                            {{-- <img src="{{ asset('storage/images/category_img/' . $category->cover_img) }}"
                                                alt="" style="max-width: 100px;max-height:100px"> --}}
                                                 <img src="{{$category->cover_img }}"
                                                alt="" style="max-width: 100px;max-height:100px">
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
            $('#add_category').click(function() {
                $('#modal-title').html('Add Category');
                $('#saveBtn').html('Add');
                $('#ajaxform')[0].reset();
            });


            // Create & Update Category
            var form = $('#ajaxform')[0];

            $('#saveBtn').click(function(e) {
                e.preventDefault();

                var formData = new FormData(form);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('category.store') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // laod the data
                        $('#data').load(location.href + ' #data');

                        $('#name').val('');
                        $('#description').val('');
                        $('#category_id').val('');


                        $('#Modal').modal('hide');
                        if (response) {
                            Swal.fire("Success", response.success, "success");
                        }
                    },
                    error: function(error) {

                        $('#saveBtn').attr('disabled', false);
                        $('#saveBtn').html('Adding...');

                        if (error.responseJSON && error.responseJSON.errors) {
                            var errors = error.responseJSON.errors;
                            $('#name-error').html(errors.name);
                            $('#banner-error').html(errors.banner);
                            $('#icon-error').html(errors.icon);
                            $('#cover-error').html(errors.cover_img);
                            console.log(errors);
                        } else {
                            console.log("An unexpected error occurred:", error);
                        }
                    },
                });
            });
            // load the data that come form server

            // Edit categorty
            $('body').on('click', '.editBtn', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('category.edit', ['category' => '__category__']) }}'.replace(
                        '__category__', id),
                    success: function(response) {
                        $('.modal').modal('show');
                        $('#modal-title').html('Edit Category');
                        $('#saveBtn').html('Update');
                        $('#category_id').val(response.id);
                        $('#name').val(response.name);
                        $('#description').val(response.description);
                    }
                });
            });

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

            //pagination category
            // $('body').on('click', '.pagination a', function(e) {
            //     e.preventDefault();
            //     let page = $(this).attr('href').split('page=')[1];
            //     category(page);

            // });

            // function category(page) {
            //     $.ajax({
            //         url: 'pagination/paginate-data?page=' + page,
            //         success: function(response) {
            //             $('#data').html(response);
            //         }
            //     });
            // }


            //search category
            $('body').on('keyup', '#search', function() {
                let Searchdata = $('#search').val();
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('category.search') }}',
                    method: 'GET',
                    data: {
                        Searchdata: Searchdata
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $('#data').html(response);
                    }
                });
            });
        });
    </script>
@endpush
