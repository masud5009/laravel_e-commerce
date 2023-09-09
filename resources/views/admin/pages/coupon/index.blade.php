@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- switch for stauts -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@endpush


@section('content')
    <!--Bootstrap modal-->
    <!-- Button trigger modal -->
    <div class="d-flex justify-content-center mb-5">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modal" id="add_coupon">
            Add Coupon
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
                        <input type="hidden" name="coupon_id" id="coupon_id">
                        <div class="form-group mb-2">
                            <label class="form-label">Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" id="code">
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label">Amount<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount" id="amount">
                            {{-- <div class="form-text">
                                Example : +88 use your coutnry dial code before write phone number
                            </div> --}}
                        </div>
                        <div>
                            <label for="type" class="form-label">Select Type</label>
                            <div class="input-group mb-2">
                                <label class="input-group-text">Type</label>
                                <select class="form-select" id="type" name="type">
                                    <option selected>Choose...</option>
                                    <option value="1">Fixed</option>
                                    <option value="2">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            {{-- <input type="date" class="form-control" id="date" name="date"> --}}
                            <input class="form-control" type="datetime-local" id="date" name="date">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="saveBtn" class="btn btn-primary"></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div style="display: none" id="bal">bal</div>
    </div>
    <!--/.Bootsttap modal-->
    <div class="col-lg-12 col-sm-12 col-md-12">
        <table id="myTable" class="table">
            <thead class="header">
                <tr>
                    <th>SL</th>
                    <th>Code</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection


@push('scripts')
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <!-- store category -->
    <script>
        $(document).ready(function() {
            $('#add_coupon').click(function() {
                $('#modal-title').html('Add Coupon');
                $('#saveBtn').html('Add');

                $('#coupon_id').val('');
                $('#code').val('');
                $('#date').val('');
                $('#amount').val('');
            });

            // Load data form serverside
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('coupon.index') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var buttonClass = data === 0 ? 'btn-success' : 'btn-secondary';
                            var buttonText = data === 0 ? 'Active' : 'Inactive';

                            return '<button class="btn btn-sm ' + buttonClass +
                                ' toggle-status" data-coupon-id="' + row.id + '">' + buttonText +
                                '</button>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ],

            });

            // Create & Update Coupon
            var form = $('#ajaxform')[0];

            $('#saveBtn').click(function() {
                var formData = new FormData(form);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('coupon.store') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        table.draw();

                        $('#code').val('');
                        $('#amount').val('');
                        $('#date').val('');


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

            // Edit Coupon
            $('body').on('click', '.editBtn', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('coupon.edit', ['coupon' => '__coupon__']) }}'.replace(
                        '__coupon__', id),
                    success: function(response) {
                        // modal section
                        $('.modal').modal('show');
                        $('#modal-title').html('Edit coupon');
                        $('#saveBtn').html('Update');

                        //input section
                        $('#type option[value="' + response.id + '"]').prop('selected', true);
                        $('#coupon_id').val(response.id);
                        $('#code').val(response.code);
                        $('#date').val(response.date);
                        $('#amount').val(response.amount);
                    }
                });
            });

            //Delete Coupon
            $('body').on('click', '.deletBtn', function() {
                var id = $(this).data('id');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this warehouse!",
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
                            url: '{{ route('coupon.destroy', ['coupon' => '__coupon__']) }}'
                                .replace(
                                    '__coupon__', id),
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                $(`[data-id="${id}"]`).closest('tr').remove();
                                Swal.fire("Success", response.success, "success");
                            },
                            error: function(xhr, status, error) {
                                // Handle errors here, if necessary
                                Swal.fire("Error",
                                    "An error occurred while deleting the coupon.",
                                    "error");
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        Swal.fire("Cancelled", "Your data is safe!", "info");
                    }
                });
            });

            // Coupon Status
            $('body').on('click', '.toggle-status', function() {
                var couponId = $(this).data('coupon-id');
                var currentStatus = $(this).hasClass('btn-success') ? 1 : 0;
                const csrfToken = $('meta[name="csrf-token"]').attr('content');


                $.ajax({
                    type: 'POST',
                    url: '{{ route('coupon.toggle-status', ['coupon' => '__coupon__']) }}'
                        .replace(
                            '__coupon__', couponId),
                    data: {
                        status: currentStatus
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            var newStatus = currentStatus === 0 ? 1 : 0;
                            var buttonClass = newStatus === 1 ? 'btn-success' :
                                'btn-secondary';
                            var buttonText = newStatus === 1 ? 'Active' :
                                'Inactive';

                            $(this).removeClass('btn-success btn-secondary')
                                .addClass(buttonClass).text(buttonText);
                        }
                    }.bind(this), // Use .bind(this) to maintain the correct button context
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

        });
    </script>
@endpush
