@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card mb-4">
                    <h5 class="card-header">Update Page</h5>
                    <div class="card-body">
                        <form action="{{ route('page.update',$page->id) }}" method="post">
                            @csrf
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="page_position" class="form-label">page position</label>
                                    <select class="form-control" name="page_position" id="page_position">
                                        <option selected disabled>Choose Option</option>
                                        {{-- <option value="1" {{ ( $page->id == $existingRecordId) ? 'selected' : '' }}>Choose Option1</option> --}}
                                        <option value="1" @if($page->page_position == 1) selected @endif>Choose Option1</option>
                                        <option value="2" @if($page->page_position == 2) selected @endif>Choose Option2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="page_name" class="form-label">page name</label>
                                        <input value="{{ $page->page_name }}" type="text" class="form-control" id="page_name" name="page_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="page_title" class="form-label">page title</label>
                                        <input value="{{ $page->page_title }}" type="text" class="form-control" id="page_title" name="page_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="page_description" class="form-label">page description</label>
                                    <textarea class="form-control" name="page_description" id="page_description" rows="4">{{ $page->page_description }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end" id="saveBtn">
                                Submit <i class='bx bxs-right-arrow'></i></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#page_description').summernote();
        });
    </script>
@endpush
