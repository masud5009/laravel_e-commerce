@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h5 class="text-dark">Attribute Detail</h5>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title border-bottom py-2">{{ $attribute->name }}</h5>
                    </div>
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
                                @if ($attribute->attributeValues)
                                    @if ($attribute->attributeValues->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">No data found</td>
                                        </tr>
                                    @else
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
                                                        data-id="">
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
                        <div class="card-title">
                            <h5 class="card-title border-bottom py-2">Add Attribute Value</h5>
                        </div>
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
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Tags <span
                                        class="text-danger fs-5">*</span></label>
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
    <script>
        $(document).ready(function(e) {
            const tagContainer = $('.tag-container');
            const tagInput = $('#product-tags');
            const addedTags = new Set();
            let maxTags = 8; // Maximum number of tags allowed

            // Function to update the countdown display
            function updateCountdown() {
                $('#countdown').text(maxTags + ' tags are remaining');
            }

            updateCountdown(); // Initial display of the countdown

            function addTag(tagValue) {
                if (maxTags > 0 && tagValue.length >= 1) {
                    const tagBadge = $('<span>').addClass('badge bg-primary tag-badge').text(tagValue);
                    const removeButton = $('<span>').addClass('badge tag-badge-remove').attr('id', 'crox-badge')
                        .text('x');

                    tagBadge.append(removeButton);
                    tagContainer.append(tagBadge);
                    addedTags.add(tagValue);
                    maxTags--;

                    updateCountdown(); // Update the countdown display

                    removeButton.click(function() {
                        tagBadge.remove();
                        addedTags.delete(tagValue);
                        maxTags++;

                        updateCountdown(); // Update the countdown display
                    });
                }
            }

            tagInput.keypress(function(event) {
                if (event.which === 13) {
                    event.preventDefault(); // Prevent the default form submission behavior
                    const tagValue = tagInput.val().trim();

                    if (tagValue !== '' && !addedTags.has(tagValue) && maxTags > 0) {
                        addTag(tagValue);
                        tagInput.val('');
                    } else {
                        tagInput.val('');
                    }
                }
            });
        });
    </script>
@endpush
