@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <!--Bootstrap modal-->
    <!-- Button trigger modal -->
    <div class="d-flex justify-content-center mb-5">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modal" id="add_subcategory">
            Add Subategory
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
                        <input type="hidden" name="subcategory_id" id="subcategory_id">
                        <div class="form-group mb-2">
                            <label class="mb-1">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1">Select Category <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="category_name"
                                id="select_category">
                                <option selected disabled>Choose Option</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Description</label>
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
    <table id="myTable" class="table">
        <thead class="header">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection


@push('scripts')
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <!-- store category -->
    <script>
        $(document).ready(function() {
            $('#add_subcategory').click(function() {
                $('#modal-title').html('Add Category');
                $('#saveBtn').html('Add');
                $('#name').val('');
                $('#description').val('');
                $('#select_category option[selected]').prop('selected', true);
            });

            // Load data form serverside
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('sub-category.index') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'category.name'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ]
            });

            // Create Sub-category
            var form = $('#ajaxform')[0];
            $('#saveBtn').click(function() {
                var formData = new FormData(form)
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('sub-category.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        table.draw();
                        $('#name').val('');
                        $('#description').val('');
                        $('#category_name').val('');
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
                            console.log(errors);
                        } else {
                            console.log("An unexpected error occurred:", error);
                        }
                    },
                });
            });

            // Edit category
            $('body').on('click', '.editBtn', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('sub-category.edit', ['sub_category' => '__subcategory__']) }}'
                        .replace(
                            '__subcategory__', id),
                    success: function(response) {
                        //basic filed dynamic
                        $('.modal').modal('show');
                        $('#modal-title').html('Edit Sub category');
                        $('#saveBtn').html('Update');

                        //input filed
                        $('#select_category option[value="' + response.category_id + '"]').prop('selected', true);
                        $('#name').val(response.name);
                        $('#description').val(response.description);
                    }
                });
            });


             //Delete category
             $('body').on('click', '.deletBtn', function() {
                var id = $(this).data('id');
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
                            url: '{{ route('sub-category.destroy', ['sub_category' => '__subcategory__']) }}'
                                .replace(
                                    '__subcategory__', id),
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                $(`[data-id="${id}"]`).closest('tr').remove();
                                Swal.fire("Success", response.success, "success");
                            },
                            error: function(xhr, status, error) {
                                // Handle errors here, if necessary
                                swal("Error",
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
