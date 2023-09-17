@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <div class="container">
        <h5 class="text-dark">All Attributes</h5>
        <div class="row">
            <div class="col-lg-8 col-sm-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title border-bottom py-2">Attributes</h5>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if ($attributes)
                                    @if ($attributes->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                    @else
                                        @foreach ($attributes as $key => $attr)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $attr->name }}</td>
                                                <td>{{ $attr->value }}</td>
                                                <td>
                                                    <a href="{{ route('attribute.edit', ['attribute' => $attr->id]) }}"
                                                        class="btn-sm btn btn-primary">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                    <a href="{{ route('attribute.show', ['attribute' => $attr->id]) }}"
                                                        class="btn-sm btn btn-secondary">
                                                        <i class="bx bx-cog"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="btn-sm btn btn-danger deletBtn"
                                                        data-id="{{ $attr->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title border-bottom py-2">Add New Attribute</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('attribute.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
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
