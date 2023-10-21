@extends('admin.layouts.app')
@push('css')
    <script src=" https://code.jquery.com/jquery-3.7.0.js"></script>
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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mt-3">
            All Coupons
        </h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal" id="add_coupon">
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
                            <label class="form-label">Coupon code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" id="code">
                            <span id="error-code" class="text-danger"></span>

                        </div>
                        <div>
                            <label for="type" class="form-label">Select Type</label>
                            <div class="input-group mb-2">
                                <label class="input-group-text">Type</label>
                                <select class="form-select" id="type" name="type">
                                    <option selected disabled>Choose...</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                            </div>
                            <span class="text-danger" id="error-type"></span>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Discount Amount<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="discount_amount" id="amount">
                            <span id="error-amount" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input class="form-control" type="date" id="date" name="date">
                            <span class="text-danger" id="error-date"></span>
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

    <script>
        $(document).ready(function() {
            $('#add_coupon').click(function() {
                $('#modal-title').html('Add Coupon');
                $('#saveBtn').html('Add');
                $('#code').val('');
                $('#amount').val('');
                $('#date').val('');
                $('#type').val('');
            });
            // Load data form serverside
            var table = $('#myTable').DataTable({
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route('coupon.index') }}',
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'discount_amount'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ],

                order: [
                    [1, 'dsc']
                ]

            });

            //Store Coupon
            var form = $('#ajaxform')[0];
            $('#saveBtn').click(function() {
                var formData = new FormData(form);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('coupon.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // table.draw();
                        $('#code').val('');
                        $('#amount').val('');
                        $('#date').val('');
                        $('#type').val('');
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
                            if (errors.code) {
                                $('#error-code').text(errors.code[0]);
                            }
                            if (errors.discount_amount) {
                                $('#error-amount').text(errors.discount_amount[0]);
                            }
                            if (errors.date) {
                                $('#error-date').text(errors.date[0]);
                            }
                            if (errors.type) {
                                $('#error-type').text(errors.type[0]);
                            }
                        } else {
                            console.log("An unexpected error occurred:", error);
                        }
                    },
                });
            });


            //Delete Coupon
            $('body').on('click', '.deletBtn', function() {
                var id = $(this).data('id');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Coupon!",
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
                                swal("Error",
                                    "An error occurred while deleting the Coupon.",
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
