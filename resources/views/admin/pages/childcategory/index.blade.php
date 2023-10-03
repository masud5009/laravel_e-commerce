@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <!--Bootstrap modal-->
    <!-- Button trigger modal -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mt-3">
            All Child Categories
        </h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal" id="add_childcategory">
            Add Child Category
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
                        <input type="hidden" name="childcategory_id" id="childcategory_id">
                        <div class="form-group mb-2">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Select Category <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="category_name"
                                id="select_category">
                                <option selected disabled>Choose Option</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Select Sub Category <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="subcategory_name"
                                id="subcategory">
                                <option selected disabled>Choose Option</option>
                            </select>
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
    <table id="myTable" class="table display nowrap" style="width:100%">
        <thead class="header">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection


@push('scripts')
    <script src=" https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <!-- datatables responsive-->
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#add_childcategory').click(function() {
                $('#modal-title').html('Add Child Category');
                $('#saveBtn').html('Add');
                $('#name').val('');
                $('#description').val('');
                $('#childcategory_id').val('');
                $('#select_category option[selected]').prop('selected', true);
                $('#select_subcategory option[selected]').prop('selected', true);
            });
            // Load data form serverside
            var table = $('#myTable').DataTable({
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route('child-category.index') }}',
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'category.name'
                    },
                    {
                        data: 'subcategory.name'
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
                    url: '{{ route('child-category.store') }}',
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
                        $('#select_category').val('');
                        $('#select_subcategory').val('');
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
                    url: '{{ route('child-category.edit', ['child_category' => '__childcategory__']) }}'
                        .replace(
                            '__childcategory__', id),
                    success: function(response) {
                        //basic filed dynamic
                        $('.modal').modal('show');
                        $('#modal-title').html('Edit Child category');
                        $('#saveBtn').html('Update');

                        //input filed
                        $('#select_category option[value="' + response.category_id + '"]').prop(
                            'selected', true);
                        $('#select_subcategory option[value="' + response.subcategory_id + '"]')
                            .prop('selected', true);
                        $('#name').val(response.name);
                        $('#description').val(response.description);
                        $('#childcategory_id').val(response.id);

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
                            url: '{{ route('child-category.destroy', ['child_category' => '__childcategory__']) }}'
                                .replace(
                                    '__childcategory__', id),
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
    <script>
        $(document).ready(function() {
            $('#select_category').change(function() {
                var categoryId = $(this).val();
                updateSubcategories(categoryId);
            });
        });

        function updateSubcategories(categoryId) {
            $.ajax({
                url: '{{ route('childcategory.selected.subcategory', ['id' => '__id__']) }}'.replace(
                    '__id__', categoryId),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#subcategory').html(
                        '<option value="" disabled>Select Subcategory</option>'); // Clear subcategory options
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
    </script>
@endpush
