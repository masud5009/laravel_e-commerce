@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <div class="d-flex justify-content-center mb-5">
        <a href="{{ route('page.create') }}" class="btn btn-success">Add Page</a>
    </div>

    <table id="myTable" class="table">
        <thead class="header">
            <tr>
                <th>SL</th>
                <th>Page name</th>
                <th>Page Title</th>
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

            $(document).ready(function() {
                $('#summernote').summernote();
            });

            $('#add_page').click(function() {
                $('#modal-title').html('Add Page');
                $('#saveBtn').html('Add');
            });

            // Load data form serverside
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('page.index') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'page_name'
                    },
                    {
                        data: 'page_title'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endpush
