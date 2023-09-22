@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mt-3">
            All Products
        </h5>
        <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <table id="myTable" class="table">
        <thead class="header">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Action</th>
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

            $(document).ready(function() {
                $('#summernote').summernote();
            });

            // Load data form serverside
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('product.index') }}',
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name'
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
        });
    </script>
@endpush
