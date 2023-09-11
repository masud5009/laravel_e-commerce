@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <div class="container">
        <h5 class="text-dark">Attribute Detail</h5>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <h5 class="card-header">{{ $attribute->name }}</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($attribute->attributeValues as $key => $values)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $values->value }}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn-sm btn btn-primary editBtn"
                                                data-id="' . $row->id . '">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn-sm btn btn-danger deletBtn"
                                                data-id="{{ $attribute->id }}">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Attribute</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('attribute.update', ['attribute' => $attribute->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Attribute Name</label>
                                <input type="text" readonly value="{{ $attribute->name }}" name="attribute_id"
                                    id="attribute_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Attribute Value</label>
                                <input type="text" name="attribute_value" id="attribute_value" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success float-end mt-3">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.Bootsttap modal-->
@endsection


@push('scripts')
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            //Delete Color
            $('body').on('click', '.deletBtn', function() {
                var id = $(this).data('id');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this color!",
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
                            url: '{{ route('attribute.destroy', ['attribute' => '__attribute__']) }}'
                                .replace(
                                    '__attribute__', id),
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
                                    "An error occurred while deleting the color.",
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
