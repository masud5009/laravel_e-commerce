@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title border-bottom py-2">General Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('generalsetting.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4 ">
                            <div class="col-lg-3">
                                <label for="logo" class="form-label">Website Logo</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="file" name="logo" class="form-control">
                            </div>
                            @if ($generalSetting)
                                <img src="{{ asset('storage/images/generalSetting/' . $generalSetting->site_logo) }}"
                                    alt="" style="max-width: 100px;max-height:100px">
                            @endif
                        </div>
                        <div class="form-group row mb-4 ">
                            <div class="col-lg-3">
                                <label for="name" class="form-label">Name</label>
                            </div>
                            <div class="col-lg-9">
                                <input value="@if ($generalSetting) {{ $generalSetting->site_name }} @endif"
                                    type="text" name="name" class="form-control" placeholder="Your site name">
                            </div>
                        </div>
                        <div class="form-group row mb-4 ">
                            <div class="col-lg-3">
                                <label for="facebook" class="form-label">Facebook Page</label>
                            </div>
                            <div class="col-lg-9">
                                <input value="@if ($generalSetting) {{ $generalSetting->facebook }} @endif"
                                    type="url" name="facebook" class="form-control"
                                    placeholder="Your facebook page url">
                            </div>
                        </div>
                        <div class="form-group row mb-4 ">
                            <div class="col-lg-3">
                                <label for="instagram" class="form-label">instagram</label>
                            </div>
                            <div class="col-lg-9">
                                <input value="@if ($generalSetting) {{ $generalSetting->instagram }} @endif"
                                    type="url" name="instagram" class="form-control"
                                    placeholder="Your instagram profile">
                            </div>
                        </div>
                        <div class="form-group row mb-4 ">
                            <div class="col-lg-3">
                                <label for="linkedin" class="form-label">linkedin</label>
                            </div>
                            <div class="col-lg-9">
                                <input value="@if ($generalSetting) {{ $generalSetting->linkedin }} @endif"
                                    type="url" name="linkedin" class="form-control" placeholder="Your linkedin url">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-end mt-3">Save</button>
                    </form>
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
