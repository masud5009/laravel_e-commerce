@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables Cdn -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mt-3">
            All Categories
        </h5>
        <a href="{{ route('category.create') }}" type="button" class="btn btn-primary">
            Add Category
        </a>
    </div>


    <div class="col-lg-12" id="Table">
        <table id="myTable" class="table">
            <thead class="header">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Banner</th>
                    <th>Icon</th>
                    <th>Cover Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if ($category->parent)
                                {{ $category->parent->name }}
                            @else
                                No Parent
                            @endif
                        </td>
                        <td>
                            @if ($category->banner)
                                <img src="{{ $category->banner ? asset($category->banner) : '-' }}" style="max-width: 50px">
                            @else
                                ---
                            @endif

                        </td>
                        <td>
                            @if ($category->icon)
                                <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" style="max-width: 25px">
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            @if ($category->cover_img)
                                <img src="{{ asset($category->cover_img) }}" alt="{{ $category->name }}"
                                    style="max-width: 25px">
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-edit"></i></a>
                            <a href="{{ route('category.destroy', $category->id) }}" class="btn btn-sm btn-danger"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
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
            $('#myTable').DataTable();
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
